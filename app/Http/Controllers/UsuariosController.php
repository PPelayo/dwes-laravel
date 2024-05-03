<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


    public function login()
    {

        return view('user.login');
    }

    function authenticate(Request $request)
    {
        $datos = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($datos)){
            $request->session()->regenerate();

            return redirect()->route('citas.index');
        }

        return back()->withErrors([
            'username' => 'El usuario y/o la contrasña no son correctos'
        ]);

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');

    }
}
