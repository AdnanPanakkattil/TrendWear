<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\User\Database\Factories\SuperadminFactory;

class Superadmin extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name_en',
        'name_ar',
        'username',
        'email',
        'password',
        'mobile_no',
        'gender',
        'role',
        'joined_date',
        'active',
    ];
}
