<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\ProductManagement\Http\Requests\ColorManagementRequest;
use Modules\ProductManagement\Models\ColorManagement;
use Yajra\DataTables\Facades\DataTables;

class ColorManagementController extends Controller
{
    /**
     * Display a listing of colors and handle DataTable AJAX requests.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ColorManagement::query()
                ->select([
                    'id',
                    'name_en',
                    'name_ar',
                    'color_code',
                    'status',
                    'is_delete',
                    'created_at',
                ])
                ->where('is_delete', 0);

            return DataTables::eloquent($query)
                ->addColumn('color_preview', function (ColorManagement $color): string {
                    $code = e($color->color_code ?? '#000000');

                    return '
                        <div class="d-flex align-items-center gap-2">
                            <span class="rounded-circle border shadow-xs d-inline-block" style="width: 22px; height: 22px; background-color: '.$code.'; flex-shrink: 0;"></span>
                            <span class="fw-semibold font-monospace">'.$code.'</span>
                        </div>
                    ';
                })
                ->addColumn('status_badge', function (ColorManagement $color): string {
                    return $color->status === 1
                        ? '<span class="badge bg-label-success">Active</span>'
                        : '<span class="badge bg-label-danger">Inactive</span>';
                })
                ->addColumn('actions', function (ColorManagement $color): string {
                    return $this->actionButtons($color->id, $color->name_en);
                })
                ->rawColumns(['color_preview', 'status_badge', 'actions'])
                ->toJson();
        }

        return view('productmanagement::colors');
    }

    /**
     * Store a newly created or update existing color.
     */
    public function store(ColorManagementRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['status'] = $request->has('status') && $request->boolean('status') ? 1 : 0;

        $colorId = $request->input('id');
        if ($colorId) {
            $color = ColorManagement::where('id', $colorId)->where('is_delete', 0)->firstOrFail();
            $color->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Color updated successfully.',
                'id' => $color->id,
            ]);
        }

        $data['is_delete'] = 0;
        $color = ColorManagement::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Color created successfully.',
            'id' => $color->id,
        ], 201);
    }

    /**
     * Get the specified color as JSON for editing.
     */
    public function edit(int|string $id): JsonResponse
    {
        $color = ColorManagement::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $color->id,
                'name_en' => $color->name_en,
                'name_ar' => $color->name_ar,
                'color_code' => $color->color_code,
                'status' => (int) $color->status,
            ],
        ]);
    }

    /**
     * Soft delete the specified color by setting is_delete to 1.
     */
    public function destroy(int|string $id): JsonResponse
    {
        $color = ColorManagement::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $color->update(['is_delete' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Color deleted successfully.',
        ]);
    }

    /**
     * Build the action dropdown buttons.
     */
    private function actionButtons(int $id, ?string $name): string
    {
        $safeName = e($name ?? 'this color');

        return '
            <div class="dropdown table-action-dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                    <i class="ti ti-dots-vertical fs-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end m-0 shadow-sm border">
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 edit-color-btn" data-id="'.$id.'">
                        <i class="ti ti-pencil me-2 text-primary fs-5"></i>
                        <span>Edit</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 text-danger delete-color-btn" data-id="'.$id.'" data-name="'.$safeName.'">
                        <i class="ti ti-trash me-2 text-danger fs-5"></i>
                        <span>Delete</span>
                    </a>
                </div>
            </div>
        ';
    }
}
