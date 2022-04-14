<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoPorRol extends Model
{
    use HasFactory;

    protected $table = "role_has_permissions";

    protected $fillable = [
        'permission_id',
        'role_id'
    ];
}
