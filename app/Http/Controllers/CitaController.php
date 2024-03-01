<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\TiposLavado;
use App\Rules\FechaValidation;
use App\Rules\MatriculaValidation;
use App\Rules\TelefonoValidation;
use DateTime;
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
        return view('citas.create');
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
            'fecha' => new FechaValidation,
            'tipos_lavado' => 'required'
        ]);

        $lavado = TiposLavado::findOrfail($datosValidos['tipos_lavado']);
        $llantas = $request->input('llantas') != null ? 1 : 0;

        $fechaEntrada = $this->generarFechaHoraCitaAleatoria(new DateTime('08:00:00'), new DateTime('17:00:00'),30, new DateTime($datosValidos['fecha']));
        $fechaSalida = $this->calcularHoraSalida($fechaEntrada, $lavado, $llantas);
        $precio = $this->calcularPrecioTotal($lavado, $llantas);


        $datosObjeto = [
            'nombre' => $datosValidos['nombre'],
            'telefono' => $datosValidos['telefono'],
            'coche' => trim($datosValidos['marca']) . ' ' . trim($datosValidos['modelo']),
            'matricula' => $datosValidos['matricula'],
            'entrada' => $fechaEntrada,
            'salida' => $fechaSalida,
            'tipos_lavado' => $datosValidos['tipos_lavado'],
            'llantas' => $llantas,
            'precio' => $precio
        ];
        //Creamos el objeto sin guardarlo en bd
        $cita = Citas::make($datosObjeto);

        //Asociamos el tipo de lavado
        $cita->tipoLavado()->associate($lavado);

        //Lo guardamos en bd
        $cita->save();

        //Y mostramos el ticket
        return redirect()->route('citas.show', ['id' => $cita->id]);
    }

    private function calcularPrecioTotal($lavado, $lavadoLlantas) : float{
        $total = $lavado->precio;

        if($lavadoLlantas == 1) $total+= 15;

        return $total;
    }

    private function calcularHoraSalida(DateTime $fechaEntrada, TiposLavado $lavado, int $lavadoLlantas) : DateTime{
        $fechaSalida = clone $fechaEntrada;

        //Me suma los minutos a la fecha de salida
        $fechaSalida->modify('+'.$lavado->tiempo. ' minutes');

        //Si esta marcado el lavado de llantas sumamos 15 minutos
        if($lavadoLlantas == 1){
            $fechaSalida->modify('+ 15 minutes');
        }

        return $fechaSalida;
    }

    /**
     * Devuelve una fecha aleatoria comprendida entre la hora de inicio y la hora de fin(incluida) pasada por parametro
     */
    private function generarFechaHoraCitaAleatoria(DateTime $horaInicio, DateTime $horaFin, int $intervaloEnMinutos = 30, DateTime $fechaAModificar) {
        //Vamos a calcular la diferencia en minutos entre la fecha de inicio y la de fin
        $diffHoras = $horaInicio->diff($horaFin);

        //Obtenemos la diferencia en minutos
        $minutosDiferencia = ($diffHoras->days * 24 * 60) + ($diffHoras->h * 60) + $diffHoras->i;

        //Vamos a dividir la diferencia entre 30 que son los intervalos de media hora, de forma que me va a decir en cuantos intervalos podremos generar para calcular una fecha aleatoria
        $intervalos =  $minutosDiferencia / $intervaloEnMinutos;


        //Una vez tenemos el numero de intervalos, obtendremos un numero aleatorio de 0 a esa cantidad
        $intervaloAletorio = random_int(0, $intervalos);

        //Pasamos eso a minutos multiplicando por 30 por que es el numero en el que lo dividimos antes por intervalos
        $minutosAleatorios = $intervaloAletorio * $intervaloEnMinutos;


        $fechaHoraCita = clone $fechaAModificar;

        //Antes de continuar y sumarle el tiempo, primero a la fecha del dia siguiente debemos establecerle la hora en la hora de inicio
        $fechaHoraCita->setTime($horaInicio->format('H'), $horaInicio->format('i'), $horaInicio->format('s'));

        //Añadimos los minutos a la fecha nueva
        $fechaHoraCita->modify("+$minutosAleatorios minutes");


        return $fechaHoraCita;

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
