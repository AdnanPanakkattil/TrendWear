<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Category\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category::index');
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('category::index');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'value' => 'nullable|string|max:120',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name_en' => $validated['name_en'],
            'name_ar' => $validated['name_ar'],
            'value' => $validated['value'] ?? null,
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
        ], 201);
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($category)
    {
        $categoryModel = Category::findOrFail($category);

        return view('category::index', ['category' => $categoryModel]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $category)
    {
        $categoryModel = Category::findOrFail($category);

        $validated = $request->validate([
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'value' => 'nullable|string|max:120',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $categoryModel->image;

        if ($request->hasFile('image')) {
            if ($categoryModel->image) {
                Storage::disk('public')->delete($categoryModel->image);
            }

            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $categoryModel->update([
            'name_en' => $validated['name_en'],
            'name_ar' => $validated['name_ar'],
            'value' => $validated['value'] ?? null,
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
        ]);
    }

    /**
     * Remove the specified category from storage (soft delete).
     */
    public function destroy($category)
    {
        $categoryModel = Category::find($category);

        if ($categoryModel) {
            $categoryModel->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.',
        ]);
    }

    /**
     * Return the category data for the datatables table.
     */
    public function data()
    {
        $query = Category::query()
            ->select([
                'id',
                'name_en',
                'name_ar',
                'value',
                'image',
                'created_at',
            ]);

        return DataTables::eloquent($query)->toJson();
    }
}
