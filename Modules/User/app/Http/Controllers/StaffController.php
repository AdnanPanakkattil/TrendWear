<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\UsersRequest;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
{
    /**
     * Show create staff form
     */
    public function index()
    {
        return view('user::staff');
    }

    /**
     * Store newly created staff
     */
    public function store(UsersRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'staff';
        $validated['active'] = $request->has('active') ? (int) $request->boolean('active') : 1;
        $validated['is_delete'] = 0;

        $staff = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Staff created successfully.',
            'role' => $staff->role,
            'id' => $staff->id,
        ], 201);
    }

    /**
     * Show edit form for staff
     */
    public function edit($id)
    {
        return view('user::staff', ['id' => $id]);
    }

    /**
     * Update specified staff
     */
    public function update(UsersRequest $request, $id)
    {
        $user = User::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $validated = $request->validated();

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['role'] = 'staff';
        $validated['active'] = $request->has('active') ? (int) $request->boolean('active') : $user->active;
        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Staff updated successfully.',
            'id' => $user->id,
        ]);
    }

    /**
     * Soft delete staff (sets is_delete = 1)
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $user->update(['is_delete' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Staff deleted successfully.',
        ]);
    }

    /**
     * DataTable data
     */
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
                'active',
                'joined_date',
            ])
            ->where('is_delete', 0)
            ->where('role', 'staff');

        return DataTables::eloquent($query)
            ->addColumn('actions', function ($row) {
                return '
                    <div class="d-inline-flex align-items-center gap-1">
                        <a href="'.route('staff.edit', $row->id).'" class="btn btn-sm btn-icon rounded-pill edit-user-btn" title="Edit" style="color: #2b76ff !important;">
                            <i class="ti ti-pencil fs-5" style="color: #2b76ff !important;"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-icon rounded-pill delete-user-btn" data-id="'.$row->id.'" data-name="'.htmlspecialchars($row->name_en ?? $row->username).'" title="Delete" style="color: #ea5455 !important;">
                            <i class="ti ti-trash fs-5" style="color: #ea5455 !important;"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
