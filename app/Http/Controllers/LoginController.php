<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the backend login page.
     */
    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('backend.dashboard');
        }

        return view('backend.login');
    }

    /**
     * Handle authentication attempt using email or username.
     */
    public function login(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'email_or_username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'email_or_username.required' => 'Email or username is required.',
            'password.required' => 'Password is required.',
        ]);

        $throttleKey = Str::transliterate(
            Str::lower($request->input('email_or_username')).'|'.$request->ip()
        );

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Too many login attempts. Please try again in '.$seconds.' seconds.',
                ], 429);
            }

            return back()->withErrors([
                'email_or_username' => 'Too many login attempts. Please try again in '.$seconds.' seconds.',
            ])->withInput();
        }

        $loginInput = trim($request->input('email_or_username'));
        $password = (string) $request->input('password');

        // Look up user by email or username (excluding soft deleted)
        $user = User::where('is_delete', 0)
            ->where(function ($query) use ($loginInput) {
                $query->where('email', $loginInput)
                    ->orWhere('username', $loginInput);
            })
            ->first();

        // Check if user exists and password is valid
        if (! $user || ! Hash::check($password, $user->password)) {
            RateLimiter::hit($throttleKey);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Credentials, Please try again.',
                ], 401);
            }

            return back()->withErrors([
                'password' => 'Invalid Credentials, Please try again.',
            ])->withInput();
        }

        // Check if user account is active
        if ((int) $user->active !== 1) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => [
                        'error_msg' => ['Your account is deactivated. Please contact administrator.'],
                    ],
                ], 403);
            }

            return back()->withErrors([
                'email_or_username' => 'Your account is deactivated. Please contact administrator.',
            ])->withInput();
        }

        // Authentication succeeded
        RateLimiter::clear($throttleKey);

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful.',
                'redirect' => route('backend.dashboard'),
            ]);
        }

        return redirect()->intended(route('backend.dashboard'));
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
