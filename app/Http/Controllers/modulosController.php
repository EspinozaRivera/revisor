<?php

namespace App\Http\Controllers;

use App\Models\modulo;
use Illuminate\Http\Request;

class modulosController extends Controller
{
    public function index()
    {
        $modulos = modulo::all();

        return $modulos;
    }
}
