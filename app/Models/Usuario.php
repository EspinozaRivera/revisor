<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuarios";

    protected $fillable = [
        'curp',
        'name',
        'apellido1',
        'apellido2',
        'correo',
        'contra',
        'status'
    ];

    protected $hidden = [
        'contra',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // protected function setCURPAttribute($curp)
    // {
    //     return strtoupper($curp);
    // }

    // protected function setCorreoAttribute($correo)
    // {
    //     return strtolower($correo);
    // }
}
