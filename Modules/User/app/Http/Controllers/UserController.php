<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * user data table list
     */


    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new user with a specific role
     */
    public function create(Request $request)
    {
        $role = $request->query('role');

        if (view()->exists('user::create')) {
            return view('user::create', compact('role'));
        }

        return redirect()->route('user.index');
    }
}
