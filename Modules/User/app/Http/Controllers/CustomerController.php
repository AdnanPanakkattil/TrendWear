<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\UsersRequest;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Show create customer form
     */
    public function index()
    {
        return view('user::customer');
    }

    /**
     * Store newly created customer
     */
    public function store(UsersRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'customer';
        $validated['active'] = $request->has('active') ? (int) $request->boolean('active') : 1;
        $validated['is_delete'] = 0;

        $customer = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully.',
            'role' => $customer->role,
            'id' => $customer->id,
        ], 201);
    }

    /**
     * Show edit form for customer
     */
    public function edit($id)
    {
        return view('user::customer', ['id' => $id]);
    }

    /**
     * Update specified customer
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

        $validated['role'] = 'customer';
        $validated['active'] = $request->has('active') ? (int) $request->boolean('active') : $user->active;
        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully.',
            'id' => $user->id,
        ]);
    }

    /**
     * Soft delete customer (sets is_delete = 1)
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $user->update(['is_delete' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully.',
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
            ->where('role', 'customer');

        return DataTables::eloquent($query)
            ->addColumn('actions', function ($row) {
                $safeName = htmlspecialchars($row->name_en ?? $row->username ?? 'this user', ENT_QUOTES, 'UTF-8');

                return '
                    <div class="dropdown table-action-dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                            <i class="ti ti-dots-vertical fs-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end m-0 shadow-sm border">
                            <a href="'.route('customer.edit', $row->id).'" class="dropdown-item d-flex align-items-center py-2 edit-user-btn">
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
