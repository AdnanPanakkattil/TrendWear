<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
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
            ->with('mediaFile:id,mediable_type,mediable_id,disk,path')
            ->select(['id', 'name_en', 'name_ar', 'created_at']);

        return DataTables::eloquent($query)
            ->addColumn('image_preview', function (Category $category): string {
                return $this->imagePreview($category->mediaFile?->url, $category->name_en);
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
        $validated = Arr::except($request->validated(), ['image']);
        $category = Category::create($validated);

        if ($request->hasFile('image')) {
            $category->syncMediaFile($request->file('image'), 'categories');
        }

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
        $category = Category::with('mediaFile')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $category->id,
                'name_en' => $category->name_en,
                'name_ar' => $category->name_ar,
                'image' => $category->mediaFile?->path,
                'image_url' => $category->mediaFile?->url,
            ],
        ]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $validated = Arr::except($request->validated(), ['image']);

        $category->update($validated);

        if ($request->hasFile('image')) {
            $category->syncMediaFile($request->file('image'), 'categories');
        }

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
    private function imagePreview(?string $imageUrl, ?string $name): string
    {
        if (! $imageUrl) {
            return '<span class="text-muted">-</span>';
        }

        return '<img src="'.e($imageUrl).'" alt="'.e($name ?? '').'" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">';
    }

    /**
     * Build the category action buttons column.
     */
    private function actionButtons(int $id, ?string $name): string
    {
        $safeName = e($name ?? 'this category');

        return '
            <div class="dropdown table-action-dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                    <i class="ti ti-dots-vertical fs-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end m-0 shadow-sm border">
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 edit-category-btn" data-id="'.$id.'">
                        <i class="ti ti-pencil me-2 text-primary fs-5"></i>
                        <span>Edit</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 text-danger delete-category-btn" data-id="'.$id.'" data-name="'.$safeName.'">
                        <i class="ti ti-trash me-2 text-danger fs-5"></i>
                        <span>Delete</span>
                    </a>
                </div>
            </div>
        ';
    }
}
