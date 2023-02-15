<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    protected $table = "revision";

    protected $fillable = [
        'id',
        'titulo',
        'nombreDoc',
        'documento',
        'revisor1',
        'r1',
        'revisor2',
        'r2',
        'revisor3',
        'r3',
        'estatus'
    ];
}
