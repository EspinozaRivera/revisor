<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPorUsuario extends Model
{
    use HasFactory;

    protected $table = "rolesPorUsuario";

    protected $fillable = [
        'idUsuario',
        'idRol',
        'estatus'
    ];
}
