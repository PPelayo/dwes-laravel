<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Citas extends Model
{
    use HasFactory;

    protected $table = "citas";
    public $timestamps = false;


    /**
     * Relacion 1 to Many.
     * En este caso estamos indicando que una cita tiene un Tipo de lavado.
     * En la tabla tipos de lavado deberiamos crear la relacion hasMany y contendria un listado de citas,
     * sin embargo en este caso no lo necesito
     */
    public function tipoLavado() : BelongsTo{
        return $this->belongsTo(TiposLavado::class, 'tipo_lavado', 'id');
    }

}
