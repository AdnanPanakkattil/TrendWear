<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Modules\ProductManagement\Http\Requests\CategoryRequest;
use Modules\ProductManagement\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productmanagement::categories');
    }

    /**
     * DataTable data source for categories.
     */
    public function data()
    {
        $query = Category::query()
            ->select(['id', 'name_en', 'name_ar', 'image', 'created_at']);

        return DataTables::eloquent($query)
            ->addColumn('image_preview', function (Category $category): string {
                return $this->imagePreview($category->image, $category->name_en);
            })
            ->addColumn('actions', function (Category $category): string {
                return $this->actionButtons($category->id, $category->name_en);
            })
            ->rawColumns(['image_preview', 'actions'])
            ->toJson();
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'id' => $category->id,
        ], 201);
    }

    /**
     * Get the specified category as JSON for editing.
     */
    public function edit($id): JsonResponse
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $category->id,
                'name_en' => $category->name_en,
                'name_ar' => $category->name_ar,
                'image' => $category->image,
                'image_url' => $category->image ? Storage::disk('public')->url($category->image) : null,
            ],
        ]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'id' => $category->id,
        ]);
    }

    /**
     * Soft delete the specified category.
     */
    public function destroy($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.',
        ]);
    }

    /**
     * Build the category image thumbnail column.
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
     * Build the category action buttons column.
     */
    private function actionButtons(int $id, ?string $name): string
    {
        return '
            <div class="d-inline-flex align-items-center gap-1">
                <button type="button" class="btn btn-sm btn-icon rounded-pill edit-category-btn" data-id="'.$id.'" title="Edit" style="color: #2b76ff !important;">
                    <i class="ti ti-pencil fs-5" style="color: #2b76ff !important;"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon rounded-pill delete-category-btn" data-id="'.$id.'" data-name="'.e($name ?? '').'" title="Delete" style="color: #ea5455 !important;">
                    <i class="ti ti-trash fs-5" style="color: #ea5455 !important;"></i>
                </button>
            </div>
        ';
    }
}
