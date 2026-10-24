<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\SuperadminStoreRequest;
use Yajra\DataTables\Facades\DataTables;

class SuperadminController extends Controller
{

    //blade page conecting ==================


    public function index()
    {
        return view('user::superadmin');
    }

    //=======================================


    // store function ==================================================

    public function store(SuperadminStoreRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $validated['role'] = 'super_admin';
        $validated['active'] = 1;

        $superadmin = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Superadmin created successfully.',
            'id' => $superadmin->id,
        ], 201);
    }

    //====================================================================

    public function data()
    {
        $query = User::query()
            ->select([
                'id',
                'name_en',
                'username',
                'email',
                'mobile_no',
                'role',
                'joined_date',
            ])
            ->where('role', 'super_admin');

        return DataTables::eloquent($query)->toJson();
    }
}
