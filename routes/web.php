<?php

use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return redirect()->route('citas.create');
});


//En el array deberemos de pasar la clase controller y de segundo argumento el metodo al que queremos acceder
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create'); //El name es un alias interno para no usar la direccion original
Route::post('citas/store', [CitaController::class, 'store'])->name('citas.store');
