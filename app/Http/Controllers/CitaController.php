<?php

namespace App\Http\Controllers;

use App\Models\Citas;
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
        $datosValidos = $request->validate([
            'nombre' => 'required',
            'telefono' => new TelefonoValidation,
            'marca' => 'required',
            'modelo' => 'required',
            'matricula' => new MatriculaValidation,
            'fecha' => new FechaValidation
        ]);

        $cita = Citas::create($datosValidos);

        $this->show($cita->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cita = Citas::findOrFail($id);

        return view('citas.show', compact('cita'));
    }
}
