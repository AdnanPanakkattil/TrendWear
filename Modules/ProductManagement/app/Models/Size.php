<?php

namespace Modules\ProductManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Size extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sizes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'status',
        'chest_inch',
        'waist_inch',
        'shoulder_inch',
        'length_inch',
        'sleeve_length_inch',
        'is_delete',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'integer',
        'is_delete' => 'integer',
        'chest_inch' => 'float',
        'waist_inch' => 'float',
        'shoulder_inch' => 'float',
        'length_inch' => 'float',
        'sleeve_length_inch' => 'float',
    ];

    /**
     * Get the category that owns the size.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
