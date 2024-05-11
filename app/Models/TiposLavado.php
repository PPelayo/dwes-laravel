<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposLavado extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "tipo_lavado";
    public $timestamps = false;

    public $keyType = 'string';

    protected $fillable = ['descripcion', 'precio', 'tiempo'];

}
