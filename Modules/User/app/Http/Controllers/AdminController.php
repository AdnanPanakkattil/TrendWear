<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\UsersRequest;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user::admin');
    }

    public function store(UsersRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        // Force admin role
        $validated['role'] = 'admin';

        $validated['active'] = 1;

        $admin = User::create($validated);

        // Verify saved role
        return response()->json([
            'success' => true,
            'message' => 'Admin created successfully.',
            'role' => $admin->role,
            'id' => $admin->id,
        ], 201);
    }
}
