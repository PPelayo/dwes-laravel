<?php

namespace App\Http\Controllers;

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
            'telefono' => 'numeric|digits:9',
            'marca' => 'required',
            'modelo' => 'required',
            'matricula' => 'required'
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
