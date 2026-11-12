<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function index(): View
    {
        return view('backend.dashboard');
    }

    public function profile(): View
    {
        return view('backend.profile', [
            'user' => Auth::user(),
        ]);
    }
}
