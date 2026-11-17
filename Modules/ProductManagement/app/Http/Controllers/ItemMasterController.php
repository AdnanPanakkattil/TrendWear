<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\ProductManagement\Http\Requests\ItemMasterRequest;
use Modules\ProductManagement\Models\Brand;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\ItemMaster;
use Modules\ProductManagement\Models\Size;
use Yajra\DataTables\Facades\DataTables;

class ItemMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productmanagement::item_master');
    }

    /**
     * DataTable data source for item masters.
     */
    public function data()
    {
        $query = ItemMaster::query()
            ->with([
                'category:id,name_en',
                'subCategory:id,name_en',
                'brand:id,name_en',
                'masterImage:id,mediable_type,mediable_id,disk,path',
            ])
            ->select([
                'id',
                'sku',
                'item_code',
                'name_en',
                'name_ar',
                'category_id',
                'sub_category_id',
                'brand_id',
                'cost_price',
                'selling_price',
                'offer_price',
                'min_retail_price',
                'min_qty',
                'offer_product_status',
                'best_selling_status',
                'featured_product',
                'created_at',
            ]);

        return DataTables::eloquent($query)
            ->addColumn('image_preview', function (ItemMaster $item): string {
                return $this->imagePreview($item->masterImage?->url, $item->name_en);
            })
            ->addColumn('category_name', function (ItemMaster $item): string {
                return e($item->category?->name_en ?? '-');
            })
            ->addColumn('sub_category_name', function (ItemMaster $item): string {
                return e($item->subCategory?->name_en ?? '-');
            })
            ->addColumn('sku_code', function (ItemMaster $item): string {
                $code = $item->sku ?: ($item->item_code ?: '-');

                return '<span class="badge bg-label-secondary font-monospace">'.e($code).'</span>';
            })
            ->addColumn('cost_price_formatted', function (ItemMaster $item): string {
                return $item->cost_price !== null ? number_format((float) $item->cost_price, 2) : '-';
            })
            ->addColumn('selling_price_formatted', function (ItemMaster $item): string {
                return $item->selling_price !== null ? number_format((float) $item->selling_price, 2) : '-';
            })
            ->addColumn('offer_price_formatted', function (ItemMaster $item): string {
                if ($item->offer_price === null) {
                    return '-';
                }

                return '<span class="badge bg-label-warning font-monospace">'.number_format((float) $item->offer_price, 2).'</span>';
            })
            ->addColumn('featured_switch', function (ItemMaster $item): string {
                $checked = $item->featured_product ? 'checked' : '';

                return '
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="form-check form-switch m-0 p-0">
                            <input class="form-check-input featured-toggle-btn"
                                   type="checkbox"
                                   role="switch"
                                   data-id="'.$item->id.'"
                                   '.$checked.'>
                        </div>
                    </div>';
            })
            ->addColumn('formatted_price', function (ItemMaster $item): string {
                if ($item->min_retail_price === null) {
                    return '-';
                }

                return number_format((float) $item->min_retail_price, 2);
            })
            ->addColumn('actions', function (ItemMaster $item): string {
                return $this->actionButtons($item->id, $item->name_en);
            })
            ->rawColumns(['image_preview', 'sku_code', 'offer_price_formatted', 'featured_switch', 'actions'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with(['subCategories' => function ($query) {
            $query->orderBy('name_en');
        }])->orderBy('name_en')->get();

        $brands = Brand::where('is_delete', 0)->orderBy('name_en')->get();

        $nextItemCode = ItemMaster::generateNextItemCode();

        return view('productmanagement::add_item_master', compact('categories', 'brands', 'nextItemCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemMasterRequest $request): JsonResponse
    {
        $payload = $this->mapPayload($request);

        $requestedCode = $request->input('itemcodeId', $request->input('item_code'));
        if (empty($requestedCode) || is_numeric($requestedCode)) {
            $payload['item_code'] = ItemMaster::generateNextItemCode();
        } else {
            $payload['item_code'] = $requestedCode;
        }

        $itemMaster = ItemMaster::create($payload);

        if ($request->hasFile('master_image')) {
            $itemMaster->syncMediaFile($request->file('master_image'), 'item_masters', 'master_image');
        }

        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                if ($subImage) {
                    $path = $subImage->store('item_masters/gallery', 'public');
                    $itemMaster->mediaFiles()->create([
                        'disk' => 'public',
                        'path' => $path,
                        'file_name' => $subImage->getClientOriginalName(),
                        'mime_type' => $subImage->getClientMimeType(),
                        'size' => $subImage->getSize(),
                        'collection' => 'sub_images',
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Item Master created successfully.',
            'redirect' => route('productmanagement.item_master'),
            'id' => $itemMaster->id,
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $itemMaster = ItemMaster::with([
            'category',
            'subCategory',
            'brand',
            'masterImage',
            'subImages',
        ])->findOrFail($id);

        $categories = Category::with(['subCategories' => function ($query) {
            $query->orderBy('name_en');
        }])->orderBy('name_en')->get();

        $brands = Brand::where('is_delete', 0)->orderBy('name_en')->get();

        $availableSizes = collect();
        if ($itemMaster->category_id) {
            $availableSizes = Size::query()
                ->where('category_id', $itemMaster->category_id)
                ->where('is_delete', 0)
                ->where('status', 1)
                ->orderBy('id')
                ->get();
        }

        return view('productmanagement::add_item_master', compact('itemMaster', 'categories', 'brands', 'availableSizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemMasterRequest $request, $id): JsonResponse
    {
        $itemMaster = ItemMaster::findOrFail($id);

        $payload = $this->mapPayload($request);
        $payload['item_code'] = $itemMaster->item_code ?? ItemMaster::generateNextItemCode();

        $itemMaster->update($payload);

        if ($request->hasFile('master_image')) {
            $itemMaster->syncMediaFile($request->file('master_image'), 'item_masters', 'master_image');
        }

        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                if ($subImage) {
                    $path = $subImage->store('item_masters/gallery', 'public');
                    $itemMaster->mediaFiles()->create([
                        'disk' => 'public',
                        'path' => $path,
                        'file_name' => $subImage->getClientOriginalName(),
                        'mime_type' => $subImage->getClientMimeType(),
                        'size' => $subImage->getSize(),
                        'collection' => 'sub_images',
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Item Master updated successfully.',
            'redirect' => route('productmanagement.item_master'),
            'id' => $itemMaster->id,
        ]);
    }

    /**
     * Soft delete the specified resource.
     */
    public function destroy($id): JsonResponse
    {
        $itemMaster = ItemMaster::findOrFail($id);
        $itemMaster->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item Master deleted successfully.',
        ]);
    }

    /**
     * Delete an existing media file attached to item master.
     */
    public function deleteMedia($id, $mediaId): JsonResponse
    {
        $itemMaster = ItemMaster::findOrFail($id);
        $media = $itemMaster->mediaFiles()->where('id', $mediaId)->firstOrFail();

        $disk = $media->disk ?: 'public';
        if ($media->path && Storage::disk($disk)->exists($media->path)) {
            Storage::disk($disk)->delete($media->path);
        }

        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image removed successfully.',
        ]);
    }

    /**
     * Toggle the featured status of an item master.
     */
    public function toggleFeatured(Request $request, $id): JsonResponse
    {
        $itemMaster = ItemMaster::findOrFail($id);
        $itemMaster->featured_product = $request->boolean('featured_product');
        $itemMaster->save();

        return response()->json([
            'success' => true,
            'message' => 'Featured product status updated successfully.',
            'featured_product' => (bool) $itemMaster->featured_product,
        ]);
    }

    /**
     * Map request input to ItemMaster model attributes.
     */
    private function mapPayload(Request $request): array
    {
        $offerEnabled = $request->boolean('offer_product_status');

        $sizeInput = $request->input('size');
        if (is_string($sizeInput)) {
            $decoded = json_decode($sizeInput, true);
            $sizeInput = is_array($decoded) ? $decoded : explode(',', $sizeInput);
        }
        $sizeIds = ! empty($sizeInput)
            ? array_values(array_filter(array_map('intval', (array) $sizeInput)))
            : null;

        return [
            'sku' => $request->input('sku'),
            'item_code' => $request->input('itemcodeId', $request->input('item_code')),
            'item_ref_code' => $request->input('item_ref_code'),
            'name_en' => $request->input('itemName_en', $request->input('name_en')),
            'name_ar' => $request->input('itemName_ar', $request->input('name_ar')),
            'category_id' => $request->filled('category_id') ? $request->input('category_id') : null,
            'sub_category_id' => $request->filled('sub_category_id') ? $request->input('sub_category_id') : null,
            'brand_id' => $request->filled('brand_id') ? $request->input('brand_id') : ($request->filled('brand') ? $request->input('brand') : null),
            'size' => $sizeIds,
            'cost_price' => $request->filled('cost_price') ? $request->input('cost_price') : null,
            'selling_price' => $request->filled('selling_price') ? $request->input('selling_price') : null,
            'offer_price' => $offerEnabled && $request->filled('offer_price') ? $request->input('offer_price') : null,
            'min_retail_price' => $request->filled('itemMinRetailPrice') ? $request->input('itemMinRetailPrice') : ($request->filled('min_retail_price') ? $request->input('min_retail_price') : null),
            'profit_level' => $request->input('itemProfitLevel', $request->input('profit_level')),
            'min_qty' => $request->filled('itemMinimunQty') ? (int) $request->input('itemMinimunQty') : ($request->filled('itenMinimunQty') ? (int) $request->input('itenMinimunQty') : null),
            'reorder_qty' => $request->filled('itemReorderQty') ? (int) $request->input('itemReorderQty') : null,
            'max_qty' => $request->filled('itemMaximunQty') ? (int) $request->input('itemMaximunQty') : null,
            'description_en' => $request->input('itemDescription', $request->input('description_en')),
            'description_ar' => $request->input('itemDescriptionAr', $request->input('description_ar')),
            'note' => $request->input('itemNote', $request->input('note')),
            'tests' => $request->input('itemTests', $request->input('tests')),
            'sample' => $request->input('itemSample', $request->input('sample')),
            'results' => $request->input('itemResults', $request->input('results')),
            'offer_product_status' => $offerEnabled,
            'best_selling_status' => $request->boolean('best_selling_status'),
            'featured_product' => $request->boolean('featured_product'),
            'offer_start_date' => $offerEnabled && $request->filled('value_from_start_date') ? $request->input('value_from_start_date') : ($offerEnabled && $request->filled('offer_start_date') ? $request->input('offer_start_date') : null),
            'offer_end_date' => $offerEnabled && $request->filled('value_from_end_date') ? $request->input('value_from_end_date') : ($offerEnabled && $request->filled('offer_end_date') ? $request->input('offer_end_date') : null),
        ];
    }

    /**
     * Build the thumbnail image preview.
     */
    private function imagePreview(?string $imageUrl, ?string $name): string
    {
        if (! $imageUrl) {
            return '<span class="text-muted">-</span>';
        }

        return '<img src="'.e($imageUrl).'" alt="'.e($name ?? '').'" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">';
    }

    /**
     * Build the action dropdown buttons.
     */
    private function actionButtons(int $id, ?string $name): string
    {
        $safeName = e($name ?? 'this item');
        $editUrl = route('productmanagement.item_master.edit', $id);

        return '
            <div class="dropdown table-action-dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                    <i class="ti ti-dots-vertical fs-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end m-0 shadow-sm border">
                    <a href="'.$editUrl.'" class="dropdown-item d-flex align-items-center py-2">
                        <i class="ti ti-pencil me-2 text-primary fs-5"></i>
                        <span>Edit</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center py-2 text-danger delete-itemmaster-btn" data-id="'.$id.'" data-name="'.$safeName.'">
                        <i class="ti ti-trash me-2 text-danger fs-5"></i>
                        <span>Delete</span>
                    </a>
                </div>
            </div>
        ';
    }
}
