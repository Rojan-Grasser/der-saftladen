<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    protected $fillable = [
        'user_id',
        'role',
    ];

    protected $casts = [
        'role' => Role::class,
    ];
}
