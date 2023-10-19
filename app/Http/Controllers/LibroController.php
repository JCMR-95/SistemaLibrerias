<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Genero;
use App\Models\Autores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{

    public function index()
    {
        $libros = Libro::all();
        $generos = Genero::all();
        $autores = Autores::all();

        return view('modulos.Libros', compact('libros', 'autores', 'generos'));
    }

    public function store(Request $request)
    {
        $datos = request()->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string'],
            'idioma' => ['required'],
            'fecha' => ['required'],
            'stock' => ['required'],
            'precio' => ['required'],
            'id_autor' => ['required'],
            'id_genero' => ['required'],
            'portada' => ['required', 'image']
        ]);

        $rutaImg = $datos["portada"]->store('Libros', 'public');

        Libro::create([
            'titulo' => $datos["titulo"],
            'sinopsis' => $datos["sinopsis"],
            'idioma' => $datos["idioma"],
            'fecha' => $datos["fecha"],
            'stock' => $datos["stock"],
            'precio' => $datos["precio"],
            'id_autor' => $datos["id_autor"],
            'id_genero' => $datos["id_genero"],
            'portada' => $rutaImg
        ]);

        return redirect('Libros')->with('LibroCreado', 'OK');
    }

    public function show($libro)
    {
        $sinopsis = Libro::find($libro);
        $libros = Libro::all();
        $generos = Genero::all();
        $autores = Autores::all();

        return view('modulos.Libros', compact('libros', 'autores', 'generos','sinopsis'));
    }

    public function edit($libro)
    {
        $libroEditar = Libro::find($libro);
        $libros = Libro::all();
        $generos = Genero::all();
        $autores = Autores::all();

        return view('modulos.Libros', compact('libros', 'autores', 'generos','libroEditar'));
    }

    public function update(Request $request, $libro)
    {
        $datos = request()->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string'],
            'idioma' => ['required'],
            'fecha' => ['required'],
            'stock' => ['required'],
            'precio' => ['required'],
            'id_autor' => ['required'],
            'id_genero' => ['required']
        ]);

        $libro = Libro::find($libro);

        $libro->titulo = $datos["titulo"];
        $libro->sinopsis = $datos["sinopsis"];
        $libro->idioma = $datos["idioma"];
        $libro->fecha = $datos["fecha"];
        $libro->stock = $datos["stock"];
        $libro->precio = $datos["precio"];
        $libro->id_genero = $datos["id_genero"];
        $libro->id_autor = $datos["id_autor"];

        if($request["portadaN"]){
            Storage::delete('public/'.$libro->portada);
            $rutaImg = $request["portadaN"]->store('Libro', 'public');
            $libro->portada = $rutaImg;
        }

        $libro->save();

        return redirect('Libros');
    }

    public function destroy($libro)
    {
        $libroEliminar = Libro::find($libro);

        if(Storage::delete('public/'.$libroEliminar->portada)){
            Libro::destroy($libro);
        }

        return redirect('Libros');
    }
}
