<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LavadosController;
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
Route::get('auth/login', [UsuariosController::class, 'login'])->name('user.login');
Route::post('auth/authenticate', [UsuariosController::class, 'authenticate'])->name('user.authenticate');
Route::get('auth/logout', [UsuariosController::class, 'logout'])->name('user.logout');

Route::get('lavados/crear', [LavadosController::class, 'create'])->name('lavados.create');
Route::get('lavados', [LavadosController::class, 'listar'])->name('lavados.listar');

Route::get('google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
