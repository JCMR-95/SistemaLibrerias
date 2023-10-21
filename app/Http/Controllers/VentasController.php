<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\Clientes;
use App\Models\User;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{

    public function create()
    {
        $clientes = Clientes::all();
        $ventas = Ventas::all()->where('estado', 'Creado');

        return view('modulos.Crear-Ventas', compact('clientes', 'ventas'));
    }

    public function store(Request $request)
    {
        $datos = request();

        Ventas::create([
            'id_cliente' => $datos["id_cliente"],
            'fecha' => $datos["fecha"],
            'estado' => 'Creado',
            'total' => '',
            'id_vendedor' => auth()->user()->id
        ]);

        return redirect('Crear-Ventas');
    }

    public function venta($id)
    {
        $venta = Ventas::find($id);
        $cliente = Clientes::find($venta->id_cliente);
        $vendedor = User::find($venta->id_vendedor);
        $libros = Libro::all();

        $librosVenta = DB::select('SELECT * FROM venta WHERE id_venta ='.$id);

        $precio = DB::table('venta')->where('id_venta', $id)->sum('precio');

        if($venta->id_vendedor != auth()->user()->id){
            return redirect('Crear-Ventas');
        }

        if($venta->estado == 'Finalizada'){
            return redirect('Ver-Ventas');
        }

        return view('modulos.Venta', compact('venta', 'cliente', 'vendedor', 'libros', 'librosVenta', 'precio'));
    }

    public function agregarLibroVenta($id)
    {
        $datos = request();

        $stockNuevo = $datos["stock"] - 1;

        DB::table('libros')->where('id', $datos["id_libro"])->update(['stock' => $stockNuevo]);

        DB::table('venta')->insert([
            'id_venta' => $datos["id_venta"],
            'id_libro' => $datos["id_libro"],
            'precio' => $datos["precio"]
        ]);

        return redirect('Venta/'.$id);
    }

    public function quitarLibroVenta($id)
    {
        $datos = request();

        $stockNuevo = $datos["stock"] - 1;

        DB::table('libros')->where('id', $datos["id_libro"])->update(['stock' => $stockNuevo]);
        DB::table('venta')->whereId($datos["id"])->delete();

        return redirect('Venta/'.$id);
    }

    public function finalizarVenta()
    {
        $datos = request();

        DB::table('ventas')->where('id', $datos['id'])->update([
            'estado' => 'Finalizada',
            'total' => $datos["total"]
        ]);

        return redirect('Ver-Ventas');
    }

    public function verVentas()
    {
        $ventas = Ventas::all()->where('estado', 'Finalizada');

        return view('modulos.Ver-Ventas')->with('ventas', $ventas);
    }

    public function verVenta($id)
    {
        $venta = Ventas::find($id);

        $libros = Libro::all();
        $cliente = Clientes::find($venta->id_cliente);
        $vendedor = User::find($venta->id_vendedor);

        $librosVenta = DB::select('SELECT * FROM venta WHERE id_venta = '.$id);

        $precio = DB::table('venta')->where('id_venta', $id)->sum('precio');

        return view('modulos.Ver-Venta', compact('venta', 'libros', 'cliente', 'vendedor', 'librosVenta', 'precio'));
    }

}
