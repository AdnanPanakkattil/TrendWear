<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\ProductManagement\Http\Requests\ItemMasterRequest;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\ItemMaster;
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
                'min_retail_price',
                'min_qty',
                'ecommerce_status',
                'offer_product_status',
                'best_selling_status',
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
            ->addColumn('formatted_price', function (ItemMaster $item): string {
                if ($item->min_retail_price === null) {
                    return '-';
                }

                return number_format((float) $item->min_retail_price, 2);
            })
            ->addColumn('status_badge', function (ItemMaster $item): string {
                return $item->ecommerce_status
                    ? '<span class="badge bg-label-success">Active</span>'
                    : '<span class="badge bg-label-secondary">Inactive</span>';
            })
            ->addColumn('actions', function (ItemMaster $item): string {
                return $this->actionButtons($item->id, $item->name_en);
            })
            ->rawColumns(['image_preview', 'sku_code', 'status_badge', 'actions'])
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

        return view('productmanagement::add_item_master', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemMasterRequest $request): JsonResponse
    {
        $payload = $this->mapPayload($request);

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
            'masterImage',
            'subImages',
        ])->findOrFail($id);

        $categories = Category::with(['subCategories' => function ($query) {
            $query->orderBy('name_en');
        }])->orderBy('name_en')->get();

        return view('productmanagement::add_item_master', compact('itemMaster', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemMasterRequest $request, $id): JsonResponse
    {
        $itemMaster = ItemMaster::findOrFail($id);

        $payload = $this->mapPayload($request);

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
     * Map request input to ItemMaster model attributes.
     */
    private function mapPayload(Request $request): array
    {
        return [
            'sku' => $request->input('sku'),
            'item_code' => $request->input('itemcodeId', $request->input('item_code')),
            'item_ref_code' => $request->input('item_ref_code'),
            'name_en' => $request->input('itemName_en', $request->input('name_en')),
            'name_ar' => $request->input('itemName_ar', $request->input('name_ar')),
            'category_id' => $request->filled('category_id') ? $request->input('category_id') : null,
            'sub_category_id' => $request->filled('sub_category_id') ? $request->input('sub_category_id') : null,
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
            'ecommerce_status' => $request->boolean('ecommerce_status'),
            'offer_product_status' => $request->boolean('offer_product_status'),
            'best_selling_status' => $request->boolean('best_selling_status'),
            'offer_start_date' => $request->filled('value_from_start_date') ? $request->input('value_from_start_date') : ($request->filled('offer_start_date') ? $request->input('offer_start_date') : null),
            'offer_end_date' => $request->filled('value_from_end_date') ? $request->input('value_from_end_date') : ($request->filled('offer_end_date') ? $request->input('offer_end_date') : null),
        ];
    }

    /**
     * Build the thumbnail image preview.
     */
    private function imagePreview(?string $imageUrl, ?string $name): string
    {
        if (! $imageUrl) {
            return '<div class="avatar avatar-sm"><span class="avatar-initial rounded bg-label-secondary"><i class="ti ti-photo"></i></span></div>';
        }

        return '<img src="'.e($imageUrl).'" alt="'.e($name ?? '').'" class="rounded" style="width: 44px; height: 44px; object-fit: cover;">';
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
