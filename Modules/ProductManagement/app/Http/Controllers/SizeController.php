<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\ProductManagement\Http\Requests\SizeRequest;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\Size;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    /**
     * Display a listing of the sizes and handle DataTable AJAX requests.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Size::query()
                ->with('category:id,name_en')
                ->select([
                    'id',
                    'name',
                    'code',
                    'category_id',
                    'status',
                    'chest_inch',
                    'waist_inch',
                    'shoulder_inch',
                    'length_inch',
                    'sleeve_length_inch',
                    'is_delete',
                    'created_at',
                ])
                ->where('is_delete', 0);

            return DataTables::eloquent($query)
                ->addColumn('category_name', function (Size $size): string {
                    return $size->category?->name_en ?? '-';
                })
                ->addColumn('status_badge', function (Size $size): string {
                    return $size->status === 1
                        ? '<span class="badge bg-label-success">Active</span>'
                        : '<span class="badge bg-label-danger">Inactive</span>';
                })
                ->addColumn('actions', function (Size $size): string {
                    return $this->actionButtons($size->id, $size->name);
                })
                ->rawColumns(['status_badge', 'actions'])
                ->toJson();
        }

        $categories = Category::orderBy('name_en')->get();

        return view('productmanagement::sizes', compact('categories'));
    }

    /**
     * Store a newly created or update existing size.
     */
    public function store(SizeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['status'] = $request->has('status') && $request->boolean('status') ? 1 : 0;

        $sizeId = $request->input('id');
        if ($sizeId) {
            $size = Size::where('id', $sizeId)->where('is_delete', 0)->firstOrFail();
            $size->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Size updated successfully.',
                'id' => $size->id,
            ]);
        }

        $data['is_delete'] = 0;
        $size = Size::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Size created successfully.',
            'id' => $size->id,
        ], 201);
    }

    /**
     * Get active sizes by category id.
     */
    public function getByCategory($categoryId): JsonResponse
    {
        $sizes = Size::query()
            ->where('category_id', $categoryId)
            ->where('is_delete', 0)
            ->where('status', 1)
            ->orderBy('id')
            ->get(['id', 'name', 'code', 'category_id']);

        return response()->json([
            'success' => true,
            'data' => $sizes,
        ]);
    }

    /**
     * Get the specified size as JSON for editing.
     */
    public function edit($id): JsonResponse
    {
        $size = Size::with('category')
            ->where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $size->id,
                'name' => $size->name,
                'code' => $size->code,
                'category_id' => $size->category_id,
                'status' => (int) $size->status,
                'chest_inch' => $size->chest_inch,
                'waist_inch' => $size->waist_inch,
                'shoulder_inch' => $size->shoulder_inch,
                'length_inch' => $size->length_inch,
                'sleeve_length_inch' => $size->sleeve_length_inch,
            ],
        ]);
    }

    /**
     * Soft delete the specified size by setting is_delete to 1.
     */
    public function destroy($id): JsonResponse
    {
        $size = Size::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $size->update(['is_delete' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Size deleted successfully.',
        ]);
    }

    /**
     * Build the action dropdown buttons.
     */
    private function actionButtons(int $id, ?string $name): string
    {
        $safeName = e($name ?? 'this size');

        return '
            <div class="dropdown table-action-dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                    <i class="ti ti-dots-vertical fs-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end m-0 shadow-sm border">
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 edit-size-btn" data-id="'.$id.'">
                        <i class="ti ti-pencil me-2 text-primary fs-5"></i>
                        <span>Edit</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 text-danger delete-size-btn" data-id="'.$id.'" data-name="'.$safeName.'">
                        <i class="ti ti-trash me-2 text-danger fs-5"></i>
                        <span>Delete</span>
                    </a>
                </div>
            </div>
        ';
    }
}
