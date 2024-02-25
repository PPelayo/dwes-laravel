<?php

namespace App\Http\Controllers;

use App\Rules\FechaValidation;
use App\Rules\MatriculaValidation;
use App\Rules\TelefonoValidation;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('citas.pedircita');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required',
            'telefono' => new TelefonoValidation,
            'marca' => 'required',
            'modelo' => 'required',
            'matricula' => new MatriculaValidation,
            'fecha' => new FechaValidation
        ]);

        return 'Enviando al post';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
