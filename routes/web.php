<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;

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
Route::post('Crear-Ventas', [ClientesController::class, 'crearClienteVenta']);

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

Route::get('Crear-Ventas', [VentasController::class, 'create']);
Route::post('Crear-Ventas', [VentasController::class, 'store']);
Route::get('Venta/{id}', [VentasController::class, 'venta']);
Route::post('Venta/{id}', [VentasController::class, 'agregarLibroVenta']);
Route::post('Quitar-Libro-Venta/{id}', [VentasController::class, 'quitarLibroVenta']);
Route::post('Finalizar-Venta', [VentasController::class, 'finalizarVenta']);
Route::get('Ver-Ventas', [VentasController::class, 'verVentas']);
Route::get('Ver-Venta/{id}', [VentasController::class, 'verVenta']);

Route::get('Pedidos', [PedidosController::class, 'index']);
Route::post('Pedidos', [PedidosController::class, 'store']);
Route::get('Pedidos-Solicitados', [PedidosController::class, 'index']);
Route::get('Pedidos-EnCamino', [PedidosController::class, 'index']);
Route::get('Pedidos-Recibidos', [PedidosController::class, 'index']);
Route::get('Gestionar-Pedido/{id}', [PedidosController::class, 'gestionar']);
Route::post('Gestionar-Pedido/{id}', [PedidosController::class, 'libroPedido']);
Route::post('CambEstadoPed/{id}', [PedidosController::class, 'cambiarEstado']);
Route::delete('LibroP-Quitar/{id}', [PedidosController::class, 'quitarLibroP']);
Route::post('Verificar/{id}', [PedidosController::class, 'verificarPedido']);
