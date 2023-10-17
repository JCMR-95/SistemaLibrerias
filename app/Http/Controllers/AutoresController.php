<?php

namespace App\Http\Controllers;

use App\Models\Autores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AutoresController extends Controller
{

    public function index()
    {
        $autores = Autores::all();

        return view('modulos.Autores')->with('autores', $autores);
    }

    public function create()
    {
        return view('modulos.Agregar-Autor');
    }

    public function store(Request $request)
    {
        $datos = request()->validate([
            'nombre' => ['required', 'string'],
            'biografia' => ['required', 'string'],
            'foto' => ['required', 'image']
        ]);

        $rutaImg = $datos["foto"]->store('Autores', 'public');

        Autores::create([
            'nombre' => $datos["nombre"],
            'foto' => $rutaImg,
            'biografia' => $datos['biografia']
        ]);

        return redirect('Autores')->with('AutorCreado', 'OK');
    }

    public function delete($autor)
    {
        $autorFoto = Autores::find($autor);

        if(Storage::delete('public/'.$autorFoto->foto)){
            Autores::destroy($autor);
        }

        return redirect('Autores');
    }
}
