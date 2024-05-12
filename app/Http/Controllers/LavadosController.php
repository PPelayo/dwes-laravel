<?php

namespace App\Http\Controllers;

use App\Models\TiposLavado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\TipoLavadoValidation;


class LavadosController extends Controller
{
    public function create(){
        if(!Auth::check()){
            return redirect()->route('user.login')->with([
                'error' => 'Debes autentificarte para acceder a esta pantalla',
                'route' => 'lavados.create'
            ]);
        }
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
        if(!Auth::check()){
            return redirect()->route('user.login')->with([
                'error' => 'Debes autentificarte para acceder a esta pantalla',
                'route' => 'lavados.listar'
            ]);
        }
        return view('lavados.listado');
    }

    function get(Request $request){
        $validation = Validator::make($request->all(), [
            'start' => 'required|numeric',
            'length' => 'required|numeric',
            'search.value' => 'nullable|string',
            'order' => 'nullable|array',
            'columns' => 'array'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'isValid' => false,
                'errors' => $validation->errors()
            ], 400);
        }

        $datos = $validation->getData();
        $columns = $datos['columns'];
        $start = $datos['start'];
        $length = $datos['length'];

        $search = $datos['search']['value'];
        $order = $datos['order'] ?? null;

        $query = TiposLavado::query();
        $recordsFiltered = $query->count();
        $totalCount = TiposLavado::count();

        if($search != null){
            $query = TiposLavado::query()->where('descripcion', 'like', "%{$search}%");
            $recordsFiltered = $query->count();
        }

        if($order != null) {
            foreach ($order as $orden) {
                $columnData = $columns[$orden['column']];
                if($columnData['orderable'] == 'true'){
                    $query = $query->orderBy($columnData['data'], $orden['dir']);
                }
            }
        }

        $tiposLavado = $query
            ->take($length)
            ->skip($start)
            ->get();

        $totalCount = TiposLavado::count();

        return response()->json([
            'columns' => $columns,
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $recordsFiltered,
            'data' => $tiposLavado
        ], 200);
    }

    function delete($id){
        $lavado = TiposLavado::find($id);
        if($lavado->citas()->count() > 0){
            return response()->json([
                'isValid' => false,
                'message' => 'No se puede eliminar el lavado porque tiene citas asociadas'
            ], 400);
        }

        $deleted = TiposLavado::where('id', $id)->delete();


        if($deleted){
            return response()->json([
                'isValid' => true,
                'message' => 'Lavado eliminado correctamente'
            ], 200);
        } else {
            return response()->json([
                'isValid' => false,
                'message' => 'No se ha podido eliminar el lavado'
            ], 400);
        }
    }
}
