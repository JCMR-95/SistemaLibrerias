<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = DB::table('pedidos')->get();

        return view('modulos.Pedidos')->with('pedidos', $pedidos);
    }

    public function store(Request $request)
    {
        $datos = request();

        Pedidos::create([
            'fecha_entrega' => $datos["fecha_entrega"],
            'fecha_envio' => $datos["fecha_envio"],
            'estado' => 'Solicitado',
            'cantidad' => 0
        ]);

        return redirect('Pedidos');
    }

    public function gestionar($id)
    {
        $pedido = Pedidos::find($id);
        $libros = Libro::all();

        $librosP = DB::table('pedido_l')->where('id_pedido', $id)->get();

        return view('modulos.Gestionar-Pedido', compact('pedido', 'libros', 'librosP'));
    }

    public function libroPedido($id)
    {
        $datos = request();
        dd('Acá');
        DB::table('pedido_l')->insert([
            'id_pedido' => $id,
            'id_libro' => $datos["id_libro"],
            'cantidad' => $datos["cantidad"],
            'estado' => ""
        ]);

        $pedido = Pedidos::find($id);

        $cantidadNueva = $pedido->cantidad + $datos["cantidad"];

        DB::table('pedidos')->where('id', $id)->update(['cantidad' => $cantidadNueva]);

        return redirect('Gestionar-Pedido/'.$id);
    }

    public function cambiarEstado($id)
    {
        $pedido = Pedidos::find($id);

        if($pedido->estado == 'Solicitado'){
            DB::table('pedidos')->where('id', $id)->update(['estado' => 'En Camino']);
        }else{
            DB::table('pedidos')->where('id', $id)->update(['estado' => 'Recibido']);
        }

        return redirect('Gestionar-Pedido/'.$id);
    }

    public function quitarLibroP($id)
    {
        $datos = request();

        $pedido = Pedidos::find($id);
        $cantidadNueva = $pedido->cantidad - $datos["cantidad"];

        DB::table('pedidos')->where('id', $id)->update(['cantidad' => $cantidadNueva]);
        DB::table('pedido_l')->where('id', $id)->delete();

        return redirect('Gestionar-Pedido/'.$id);
    }

    public function verificarPedido($id)
    {
        $datos = request();

        $libro = Libro::find($datos["id_libro"]);
        $stockNuevo = $libro->stock + $datos["cantidad"];

        DB::table('libros')->where('id', $datos["id_libro"])->update(['stock' => $stockNuevo]);
        DB::table('pedido_l')->where('id', $datos["id_lp"])->update(['estado' => 'Verificado']);

        return redirect('Gestionar-Pedido/'.$id);
    }

}
