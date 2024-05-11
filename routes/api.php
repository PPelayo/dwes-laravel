<?php

use App\Http\Controllers\LavadosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/', function (Request $request) {
//     return 'Hola Mundo';
// });

Route::post('/lavados/validate', [LavadosController::class, 'validateRequest'])->name('lavados.validate');
Route::post('/lavados', [LavadosController::class, 'store'])->name('lavados.store');

