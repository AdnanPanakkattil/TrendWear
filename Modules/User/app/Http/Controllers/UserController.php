<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function data(Request $request)
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
            ->where('is_delete', 0);

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->has('status') && $request->input('status') !== null && $request->input('status') !== '') {
            $query->where('active', (int) $request->input('status'));
        }

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
