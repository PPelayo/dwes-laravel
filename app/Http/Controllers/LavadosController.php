<?php

namespace App\Http\Controllers;

use App\Models\TiposLavado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\TipoLavadoValidation;


class LavadosController extends Controller
{
    public function create(){
        return view('lavados.create');
    }

    public function validateRequest(Request $request){
        $validador = Validator::make($request->all(),
        [
            'nombre' => ['required', new TipoLavadoValidation],
            'precio' => 'required|numeric|gt:0',
            'tiempo' => 'required|numeric|gt:0',
        ]);


        if($validador->fails()){
            //Manejar error
            return response()->json([
                'isValid' => false,
                'errors' => $validador->errors()
            ], 400);
        }

        return response()->json([
            'isValid' => true
        ], 200);
    }

    public function store(Request $request){

        $validacion = $this->validateRequest($request);
        if($validacion->getData()->isValid == false){
            return $validacion;
        }

        //Sabiendo que no hay fallos podemos crear el tipo de lavado

        TiposLavado::create([
            'descripcion' => $request->nombre,
            'precio' => $request->precio,
            'tiempo' => $request->tiempo
        ]);

        return response()->json([
            'isValid' => true,
            'message' => 'Lavado creado correctamente'
        ], 200);
    }


    function listar(){
        return view
    }
}
