<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\User\Http\Requests\UsersRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display users list page with summary counts
     */
    public function index()
    {
        $counts = [
            'total' => User::where('is_delete', 0)->count(),
            'super_admin' => User::where('role', 'super_admin')->where('is_delete', 0)->count(),
            'admin' => User::where('role', 'admin')->where('is_delete', 0)->count(),
            'staff' => User::where('role', 'staff')->where('is_delete', 0)->count(),
            'customer' => User::where('role', 'customer')->where('is_delete', 0)->count(),
        ];

        return view('user::index', compact('counts'));
    }

    /**
     * Show create user page (if needed)
     */
    public function create(Request $request)
    {
        $role = $request->query('role');

        if ($role === 'super_admin') {
            return redirect()->route('backend.superadmin');
        } elseif ($role === 'admin') {
            return redirect()->route('backend.admin');
        } elseif ($role === 'staff') {
            return redirect()->route('backend.staff');
        } elseif ($role === 'inventory_manager') {
            return redirect()->route('backend.inventorymanager');
        }

        if (view()->exists('user::create')) {
            return view('user::create', compact('role'));
        }

        return redirect()->route('user.index');
    }

    /**
     * Redirect to specific role edit page
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->where('is_delete', 0)->firstOrFail();

        if ($user->role === 'super_admin') {
            return redirect()->route('superadmin.edit', $id);
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.edit', $id);
        }

        return redirect()->route('user.index');
    }

    /**
     * Soft delete user (is_delete = 1)
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $user->update(['is_delete' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
        ]);
    }

    /**
     * Get single user as JSON for JS edit loading
     */
    public function showUser($id)
    {
        $user = User::where('id', $id)->where('is_delete', 0)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    /**
     * DataTable data source for users
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
            ->where('is_delete', 0);

        return DataTables::eloquent($query)
            ->addColumn('actions', function ($row) {
                $editUrl = $row->role === 'super_admin'
                    ? route('superadmin.edit', $row->id)
                    : ($row->role === 'admin' ? route('admin.edit', $row->id) : route('user.edit', $row->id));

                return '
                    <div class="d-inline-flex align-items-center gap-1">
                        <a href="' . $editUrl . '" class="btn btn-sm btn-icon rounded-pill edit-user-btn" title="Edit" style="color: #2b76ff !important;">
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
