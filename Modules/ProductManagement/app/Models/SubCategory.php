<?php

namespace Modules\ProductManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name_en',
        'name_ar',
        'image',
    ];

    /**
     * Get the category that owns the sub category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
