<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\UsersRequest;
use Yajra\DataTables\Facades\DataTables;

class SuperadminController extends Controller
{
    /**
     * Show create superadmin form
     */
    public function index()
    {
        return view('user::superadmin');
    }

    /**
     * Store a newly created superadmin
     */
    public function store(UsersRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'super_admin';
        $validated['active'] = $request->has('active') ? (int) $request->boolean('active') : 1;
        $validated['is_delete'] = 0;

        $superadmin = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Superadmin created successfully.',
            'id' => $superadmin->id,
        ], 201);
    }

    /**
     * Show edit form for superadmin
     */
    public function edit($id)
    {
        return view('user::superadmin', ['id' => $id]);
    }

    /**
     * Update specified superadmin
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

        $validated['role'] = 'super_admin';
        $validated['active'] = $request->has('active') ? (int) $request->boolean('active') : $user->active;
        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Superadmin updated successfully.',
            'id' => $user->id,
        ]);
    }

    /**
     * Soft delete superadmin (sets is_delete = 1)
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $user->update(['is_delete' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Superadmin deleted successfully.',
        ]);
    }

    /**
     * Data table source for users
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
            ->whereIn('role', [
                'super_admin',
                'admin',
                'staff',
                'inventory_manager',
                'customer',
            ]);

        return DataTables::eloquent($query)
            ->addColumn('actions', function ($row) {
                switch ($row->role) {
                    case 'super_admin':
                        $editUrl = route('superadmin.edit', $row->id);
                        break;
                    case 'admin':
                        $editUrl = route('admin.edit', $row->id);
                        break;
                    case 'staff':
                        $editUrl = route('staff.edit', $row->id);
                        break;
                    case 'inventory_manager':
                        $editUrl = route('inventorymanager.edit', $row->id);
                        break;
                    case 'customer':
                        $editUrl = route('customer.edit', $row->id);
                        break;
                    default:
                        $editUrl = route('user.edit', $row->id);
                        break;
                }

                return '
                    <div class="d-inline-flex align-items-center gap-1">
                        <a href="'.$editUrl.'" class="btn btn-sm btn-icon rounded-pill edit-user-btn" title="Edit" style="color: #2b76ff !important;">
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
