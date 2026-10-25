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
        $validated['active'] = 1;
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

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['role'] = 'customer';
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
                'joined_date',
            ])
            ->where('is_delete', 0)
            ->where('role', 'customer');

        return DataTables::eloquent($query)
            ->addColumn('actions', function ($row) {
                return '
                    <div class="d-inline-flex align-items-center gap-1">
                        <a href="' . route('customer.edit', $row->id) . '" class="btn btn-sm btn-icon rounded-pill edit-user-btn" title="Edit" style="color: #2b76ff !important;">
                            <i class="ti ti-pencil fs-5" style="color: #2b76ff !important;"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-icon rounded-pill delete-user-btn" data-id="' . $row->id . '" data-name="' . htmlspecialchars($row->name_en ?? $row->username) . '" title="Delete" style="color: #ea5455 !important;">
                            <i class="ti ti-trash fs-5" style="color: #ea5455 !important;"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
