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


    public function login($route = null)
    {

        return view('user.login', with(['route' => $route]));
    }

    function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'route' => 'nullable'
        ]);
        $userDatos = [
            'username' => $request->username,
            'password' => $request->password
        ];


        if(Auth::attempt($userDatos)){
            $request->session()->regenerate();

            if($request->route != null){
                return redirect()->route($request->route);
            }
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
