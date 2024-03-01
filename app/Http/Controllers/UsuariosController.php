<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    public function create()
    {
        $datos =[
            'username' => 'admin',
            'password' => Hash::make('123')
        ];

        $user = Usuarios::create($datos);

        return 'Admin creado' . json_encode($user);
    }
}
