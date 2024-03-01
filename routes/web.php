<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\UsuariosController;
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
Route::get('citas/show/{id}', [CitaController::class, 'show'])->name('citas.show');
Route::get('citas/index/', [CitaController::class, 'index'])->name('citas.index');


Route::get('user/create', [UsuariosController::class, 'create'])->name('user.create');
