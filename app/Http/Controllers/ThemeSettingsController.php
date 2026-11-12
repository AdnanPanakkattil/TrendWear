<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThemeSettingsController extends Controller
{
    /**
     * Persist the authenticated user's preferred dashboard color theme.
     */
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'theme_color' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $color = strtolower($validated['theme_color']);

        /** @var User $user */
        $user = $request->user();
        $user->update([
            'theme_color' => $color,
        ]);

        return response()->json([
            'success' => true,
            'theme_color' => $color,
            'palette' => User::resolveThemePalette($color),
        ]);
    }
}
