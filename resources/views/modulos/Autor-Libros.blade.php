@extends('plantilla')

@section('contenido')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Libros</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#AgregarLibro">Agregar Libro</button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped DT1">
                    <thead>
                        <tr>
                            <th>T&iacute;tulo</th>
                            <th>G&eacute;nero</th>
                            <th>Sinopsis</th>
                            <th>Idioma</th>
                            <th>Portada</th>
                            <th>Fecha de Publicaci&oacute;n</th>
                            <th>Stock</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($libros as $libro)
                            <tr>
                                <td>{{ $libro->titulo }}</td>
                                <td>{{ $libro->genero->nombre }}</td>
                                <td>
                                    {{ Str::limit($libro->sinopsis, 200) }}
                                    <a href="{{ url('Libro-Sinopsis/'.$libro->id) }}">
                                        <button class="btn btn-default btn-xs">Leer</button>
                                    </a>
                                </td>
                                <td>{{ $libro->idioma }}</td>
                                <td><img src="{{ url('storage/'.$libro->portada) }}" width="50px"></td>
                                <td>{{ $libro->fecha }}</td>

                                @if($libro->stock < 10 && $libro->stock > 5)
                                    <td><button class="btn btn-warning"> {{ $libro->stock }}</button></td>
                                @elseif($libro->stock <= 5)
                                    <td><button class="btn btn-danger"> {{ $libro->stock }}</button></td>
                                @else
                                    <td><button class="btn btn-success"> {{ $libro->stock }}</button></td>
                                @endif

                                <td>{{ $libro->precio }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection
