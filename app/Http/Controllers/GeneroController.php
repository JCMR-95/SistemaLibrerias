<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneroController extends Controller
{

    public function index()
    {
        $generos = Genero::all();

        return view('modulos.Generos')->with('generos', $generos);
    }

    public function store(Request $request)
    {
        $datos = request();

        DB::table('generos')->insert(['nombre' => $datos['nombre']]);

        return redirect('Generos');
    }

    public function update(Request $request, Genero $genero)
    {
        $genero = Genero::find($genero->id);
        $genero->nombre = request('nombre');
        $genero->save();

        return redirect('Generos');
    }

    public function destroy($id)
    {
        DB::table('generos')->whereId($id)->delete();

        return redirect('Generos');
    }
}
