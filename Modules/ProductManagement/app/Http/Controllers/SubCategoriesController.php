<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Modules\ProductManagement\Http\Requests\SubCategoryRequest;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\SubCategory;
use Yajra\DataTables\Facades\DataTables;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()
            ->orderBy('name_en')
            ->get(['id', 'name_en']);

        return view('productmanagement::sub_categories', compact('categories'));
    }

    /**
     * DataTable data source for sub categories.
     */
    public function data()
    {
        $query = SubCategory::query()
            ->with([
                'category:id,name_en',
                'mediaFile:id,mediable_type,mediable_id,disk,path',
            ])
            ->select(['id', 'category_id', 'name_en', 'name_ar', 'created_at']);

        return DataTables::eloquent($query)
            ->addColumn('category_name', function (SubCategory $subCategory): string {
                return e($subCategory->category?->name_en ?? '-');
            })
            ->addColumn('image_preview', function (SubCategory $subCategory): string {
                return $this->imagePreview($subCategory->mediaFile?->url, $subCategory->name_en);
            })
            ->addColumn('actions', function (SubCategory $subCategory): string {
                return $this->actionButtons($subCategory->id, $subCategory->name_en);
            })
            ->rawColumns(['image_preview', 'actions'])
            ->toJson();
    }

    /**
     * Store a newly created sub category in storage.
     */
    public function store(SubCategoryRequest $request): JsonResponse
    {
        $validated = Arr::except($request->validated(), ['image']);
        $subCategory = SubCategory::create($validated);

        if ($request->hasFile('image')) {
            $subCategory->syncMediaFile($request->file('image'), 'sub_categories');
        }

        return response()->json([
            'success' => true,
            'message' => 'Sub category created successfully.',
            'id' => $subCategory->id,
        ], 201);
    }

    /**
     * Get the specified sub category as JSON for editing.
     */
    public function edit($id): JsonResponse
    {
        $subCategory = SubCategory::with('mediaFile')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $subCategory->id,
                'category_id' => $subCategory->category_id,
                'name_en' => $subCategory->name_en,
                'name_ar' => $subCategory->name_ar,
                'image' => $subCategory->mediaFile?->path,
                'image_url' => $subCategory->mediaFile?->url,
            ],
        ]);
    }

    /**
     * Update the specified sub category in storage.
     */
    public function update(SubCategoryRequest $request, $id): JsonResponse
    {
        $subCategory = SubCategory::findOrFail($id);
        $validated = Arr::except($request->validated(), ['image']);

        $subCategory->update($validated);

        if ($request->hasFile('image')) {
            $subCategory->syncMediaFile($request->file('image'), 'sub_categories');
        }

        return response()->json([
            'success' => true,
            'message' => 'Sub category updated successfully.',
            'id' => $subCategory->id,
        ]);
    }

    /**
     * Soft delete the specified sub category.
     */
    public function destroy($id): JsonResponse
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sub category deleted successfully.',
        ]);
    }

    /**
     * Build the sub category image thumbnail column.
     */
    private function imagePreview(?string $imageUrl, ?string $name): string
    {
        if (! $imageUrl) {
            return '<span class="text-muted">-</span>';
        }

        return '<img src="'.e($imageUrl).'" alt="'.e($name ?? '').'" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">';
    }

    /**
     * Build the sub category action buttons column.
     */
    private function actionButtons(int $id, ?string $name): string
    {
        return '
            <div class="d-inline-flex align-items-center gap-1">
                <button type="button" class="btn btn-sm btn-icon rounded-pill edit-subcategory-btn" data-id="'.$id.'" title="Edit" style="color: #2b76ff !important;">
                    <i class="ti ti-pencil fs-5" style="color: #2b76ff !important;"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon rounded-pill delete-subcategory-btn" data-id="'.$id.'" data-name="'.e($name ?? '').'" title="Delete" style="color: #ea5455 !important;">
                    <i class="ti ti-trash fs-5" style="color: #ea5455 !important;"></i>
                </button>
            </div>
        ';
    }
}
