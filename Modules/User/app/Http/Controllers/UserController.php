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
            'inventory_manager' => User::where('role', 'inventory_manager')->where('is_delete', 0)->count(),
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
        } elseif ($role === 'customer') {
            return redirect()->route('backend.customer');
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
        } elseif ($user->role === 'staff') {
            return redirect()->route('staff.edit', $id);
        } elseif ($user->role === 'inventory_manager') {
            return redirect()->route('inventorymanager.edit', $id);
        } elseif ($user->role === 'customer') {
            return redirect()->route('customer.edit', $id);
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
