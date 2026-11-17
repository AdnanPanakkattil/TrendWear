<?php

namespace Modules\ProductManagement\Models;

use App\Models\MediaFile;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemMaster extends Model
{
    use HasMedia, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_masters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sku',
        'item_code',
        'item_ref_code',
        'name_en',
        'name_ar',
        'category_id',
        'sub_category_id',
        'cost_price',
        'selling_price',
        'offer_price',
        'min_retail_price',
        'profit_level',
        'min_qty',
        'reorder_qty',
        'max_qty',
        'description_en',
        'description_ar',
        'note',
        'tests',
        'sample',
        'results',
        'ecommerce_status',
        'offer_product_status',
        'best_selling_status',
        'featured_product',
        'offer_start_date',
        'offer_end_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ecommerce_status' => 'boolean',
        'offer_product_status' => 'boolean',
        'best_selling_status' => 'boolean',
        'featured_product' => 'boolean',
        'offer_start_date' => 'date',
        'offer_end_date' => 'date',
        'min_retail_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'offer_price' => 'decimal:2',
    ];

    /**
     * Get the category that owns the item.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the sub category that owns the item.
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * Get the master cover image media file.
     */
    public function masterImage(): MorphOne
    {
        return $this->morphOne(MediaFile::class, 'mediable')
            ->where('collection', 'master_image');
    }

    /**
     * Get all gallery sub images media files.
     */
    public function subImages(): MorphMany
    {
        return $this->morphMany(MediaFile::class, 'mediable')
            ->where('collection', 'sub_images');
    }

    /**
     * Get master image URL accessor.
     */
    public function getMasterImageUrlAttribute(): ?string
    {
        return $this->masterImage?->url ?? $this->mediaFile?->url;
    }
}
