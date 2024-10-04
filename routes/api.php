<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
Route::get('/products', [ProductController::class, 'index']); // Listar productos activos
Route::get('/products/{id}', [ProductController::class, 'show']); // Mostrar un producto específico
Route::post('/product/save', [ProductController::class, 'create']); // Crear un nuevo producto (cambiado a 'save')
Route::put('/product/update/{id}', [ProductController::class, 'update']); // Actualizar un producto existente (cambiado a 'update')
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy']); // Eliminar un producto