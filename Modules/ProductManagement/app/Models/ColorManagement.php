<?php

namespace Modules\ProductManagement\Models;

use Illuminate\Database\Eloquent\Model;

class ColorManagement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'color_management';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_en',
        'name_ar',
        'color_code',
        'status',
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
    ];
}
