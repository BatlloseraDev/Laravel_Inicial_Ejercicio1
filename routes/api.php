<?php

use App\Http\Controllers\ControlladorEjercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get("/devolucion",[ControlladorEjercicio::class, 'calcularMonedasGetJSON'] );
Route::get('/edad/{fechaNacimiento}/{fechaActual?}',[ControlladorEjercicio::class,'calcularEdad'] );
Route::get('/suma/{numero1}/{numero2?}',[ControlladorEjercicio::class,'sumaDigitos'] );
