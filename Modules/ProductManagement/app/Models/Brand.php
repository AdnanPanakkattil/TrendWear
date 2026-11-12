<?php

namespace Modules\ProductManagement\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_en',
        'name_ar',
        'is_delete',
    ];
}
