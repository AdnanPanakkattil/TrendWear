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

    
}
