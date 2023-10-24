<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use App\Models\Ventas;
use App\Models\Libro;
use App\Models\Clientes;
use App\Models\Pedidos;
use Illuminate\Http\Request;

class InicioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ventas = Ventas::all()->where('estado', 'Finalizada');
        $libros = Libro::all();
        $clientes = Clientes::all();
        $pedidos = Pedidos::all()->where('estado', 'En Camino');

        return view('modulos.Inicio', compact('ventas', 'libros', 'clientes', 'pedidos'));
    }

}
