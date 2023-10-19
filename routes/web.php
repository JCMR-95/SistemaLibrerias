<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\LibroController;

Route::get('/', function () {
    return view('modulos.Ingresar');
});

Auth::routes();

Route::get('Inicio', [InicioController::class, 'index']);

Route::get('Mis-Datos', [UsuariosController::class, 'MisDatos']);
Route::put('Mis-Datos', [UsuariosController::class, 'DatosUpdate']);

Route::get('Usuarios', [UsuariosController::class, 'index']);
Route::post('Usuarios', [UsuariosController::class, 'store']);
Route::get('Eliminar-Usuario/{id}', [UsuariosController::class, 'destroy']);
Route::get('Editar-Usuario/{id}', [UsuariosController::class, 'edit']);
Route::put('actualizar-Usuario/{id}', [UsuariosController::class, 'update']);

Route::get('Clientes', [ClientesController::class, 'index']);
Route::post('Clientes', [ClientesController::class, 'store']);
Route::get('Editar-Cliente/{id}', [ClientesController::class, 'edit']);
Route::put('actualizar-Cliente/{id}', [ClientesController::class, 'update']);
Route::get('Eliminar-Cliente/{id}', [ClientesController::class, 'destroy']);


Route::get('Generos', [GeneroController::class, 'index']);
Route::post('Generos', [GeneroController::class, 'store']);
Route::get('Genero-Libros/{id_genero}', [GeneroController::class, 'generoLibros']);
Route::put('actualizar-Genero/{genero}', [GeneroController::class, 'update']);
Route::get('Eliminar-Genero/{id}', [GeneroController::class, 'destroy']);

Route::get('Autores', [AutoresController::class, 'index']);
Route::get('Agregar-Autor', [AutoresController::class, 'create']);
Route::post('Agregar-Autor', [AutoresController::class, 'store']);
Route::delete('Quitar-Autor/{autor}', [AutoresController::class, 'delete']);
Route::get('Autor-Libros/{id_autor}', [AutoresController::class, 'autorLibros']);

Route::get('Libros', [LibroController::class, 'index']);
Route::post('Libros', [LibroController::class, 'store']);
Route::get('Libro-Sinopsis/{id}', [LibroController::class, 'show']);
Route::get('Editar-Libro/{id}', [LibroController::class, 'edit']);
Route::put('Actualizar-Libro/{id}', [LibroController::class, 'update']);
Route::get('Eliminar-Libro/{id}', [LibroController::class, 'destroy']);
