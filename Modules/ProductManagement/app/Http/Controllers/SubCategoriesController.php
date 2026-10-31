<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
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
            ->with('category:id,name_en')
            ->select(['id', 'category_id', 'name_en', 'name_ar', 'image', 'created_at']);

        return DataTables::eloquent($query)
            ->addColumn('category_name', function (SubCategory $subCategory): string {
                return e($subCategory->category?->name_en ?? '-');
            })
            ->addColumn('image_preview', function (SubCategory $subCategory): string {
                return $this->imagePreview($subCategory->image, $subCategory->name_en);
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
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sub_categories', 'public');
        }

        $subCategory = SubCategory::create($validated);

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
        $subCategory = SubCategory::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $subCategory->id,
                'category_id' => $subCategory->category_id,
                'name_en' => $subCategory->name_en,
                'name_ar' => $subCategory->name_ar,
                'image' => $subCategory->image,
                'image_url' => $subCategory->image ? Storage::disk('public')->url($subCategory->image) : null,
            ],
        ]);
    }

    /**
     * Update the specified sub category in storage.
     */
    public function update(SubCategoryRequest $request, $id): JsonResponse
    {
        $subCategory = SubCategory::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($subCategory->image && Storage::disk('public')->exists($subCategory->image)) {
                Storage::disk('public')->delete($subCategory->image);
            }

            $validated['image'] = $request->file('image')->store('sub_categories', 'public');
        }

        $subCategory->update($validated);

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
    private function imagePreview(?string $image, ?string $name): string
    {
        if (! $image) {
            return '<span class="text-muted">-</span>';
        }

        $url = Storage::disk('public')->url($image);

        return '<img src="'.e($url).'" alt="'.e($name ?? '').'" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">';
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
