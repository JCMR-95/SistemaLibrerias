@extends('plantilla')

@section('contenido')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Géneros Literarios</h1>
        <br>
        <form method="post">

            @csrf
            <div class="col-md-3 col-xs-12">
                <input type="text" class="form-control" name="nombre" placeholder="Ingrese Nuevo Género" required>

                <button class="btn- btn-primary" type="submit">Agregar</button>
            </div>
        </form>
    </section>
    <section class="content" style="padding-top: 75px;">
        <div class="box">
            <div class="box-body">

                @foreach ($generos as $genero)
                    <div class="row">
                        <form method="post" action="{{ url('actualizar-Genero/'.$genero->id) }}">

                            @csrf
                            @method('put')
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="nombre" value="{{$genero->nombre}}">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary">Ver Libros</button>
                                <button class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                <a href="{{ url('Eliminar-Genero/'.$genero->id) }}">
                                    <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                </a>
                            </div>
                        </form>
                    </div>
                    <br>
                @endforeach

            </div>
        </div>
    </section>
</div>


@endsection
