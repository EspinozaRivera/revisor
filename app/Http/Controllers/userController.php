<?php

namespace App\Http\Controllers;

use App\Models\User;

class userController extends Controller
{
    public function index(){
        
        $usuarios = User::all();

        return $usuarios;
    }

    public function show($id){
        $usuario = User::where('id',$id)->get()->first();

        return $usuario;
    }
}
