<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposLavado extends Model
{
    use HasFactory;

    protected $table = "tipo_lavado";
    public $timestamps = false;


}