<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Modules\ProductManagement\Http\Requests\BrandRequest;
use Modules\ProductManagement\Models\Brand;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productmanagement::brands');
    }

    /**
     * DataTable data source for brands.
     */
    public function data()
    {
        $query = Brand::query()
            ->with('mediaFile:id,mediable_type,mediable_id,disk,path')
            ->select(['id', 'name_en', 'name_ar', 'is_delete', 'created_at'])
            ->where('is_delete', 0);

        return DataTables::eloquent($query)
            ->addColumn('image_preview', function (Brand $brand): string {
                return $this->imagePreview($brand->mediaFile?->url, $brand->name_en);
            })
            ->addColumn('actions', function (Brand $brand): string {
                return $this->actionButtons($brand->id, $brand->name_en);
            })
            ->rawColumns(['image_preview', 'actions'])
            ->toJson();
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(BrandRequest $request): JsonResponse
    {
        $validated = Arr::except($request->validated(), ['image']);
        $brand = Brand::create($validated);

        if ($request->hasFile('image')) {
            $brand->syncMediaFile($request->file('image'), 'brands');
        }

        return response()->json([
            'success' => true,
            'message' => 'Brand created successfully.',
            'id' => $brand->id,
        ], 201);
    }

    /**
     * Get the specified brand as JSON for editing.
     */
    public function edit($id): JsonResponse
    {
        $brand = Brand::with('mediaFile')
            ->where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $brand->id,
                'name_en' => $brand->name_en,
                'name_ar' => $brand->name_ar,
                'image' => $brand->mediaFile?->path,
                'is_delete' => $brand->is_delete,
                'image_url' => $brand->mediaFile?->url,
            ],
        ]);
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(BrandRequest $request, $id): JsonResponse
    {
        $brand = Brand::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $validated = Arr::except($request->validated(), ['image']);

        $brand->update($validated);

        if ($request->hasFile('image')) {
            $brand->syncMediaFile($request->file('image'), 'brands');
        }

        return response()->json([
            'success' => true,
            'message' => 'Brand updated successfully.',
            'id' => $brand->id,
        ]);
    }

    /**
     * Soft delete the specified brand by setting is_delete to 1.
     */
    public function destroy($id): JsonResponse
    {
        $brand = Brand::where('id', $id)->where('is_delete', 0)->firstOrFail();
        $brand->update(['is_delete' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Brand deleted successfully.',
        ]);
    }

    /**
     * Build the brand image thumbnail column.
     */
    private function imagePreview(?string $imageUrl, ?string $name): string
    {
        if (! $imageUrl) {
            return '<span class="text-muted">-</span>';
        }

        return '<img src="'.e($imageUrl).'" alt="'.e($name ?? '').'" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">';
    }

    /**
     * Build the brand action buttons column.
     */
    private function actionButtons(int $id, ?string $name): string
    {
        $safeName = e($name ?? 'this brand');

        return '
            <div class="dropdown table-action-dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                    <i class="ti ti-dots-vertical fs-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end m-0 shadow-sm border">
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 edit-brand-btn" data-id="'.$id.'">
                        <i class="ti ti-pencil me-2 text-primary fs-5"></i>
                        <span>Edit</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 text-danger delete-brand-btn" data-id="'.$id.'" data-name="'.$safeName.'">
                        <i class="ti ti-trash me-2 text-danger fs-5"></i>
                        <span>Delete</span>
                    </a>
                </div>
            </div>
        ';
    }
}
