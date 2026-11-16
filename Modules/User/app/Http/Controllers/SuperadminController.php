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

                $safeName = htmlspecialchars($row->name_en ?? $row->username ?? 'this user', ENT_QUOTES, 'UTF-8');

                return '
                    <div class="dropdown table-action-dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                            <i class="ti ti-dots-vertical fs-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end m-0 shadow-sm border">
                            <a href="'.$editUrl.'" class="dropdown-item d-flex align-items-center py-2 edit-user-btn">
                                <i class="ti ti-pencil me-2 text-primary fs-5"></i>
                                <span>Edit</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 text-danger delete-user-btn" data-id="'.$row->id.'" data-name="'.$safeName.'">
                                <i class="ti ti-trash me-2 text-danger fs-5"></i>
                                <span>Delete</span>
                            </a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
