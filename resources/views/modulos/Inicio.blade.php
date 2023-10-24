@extends('plantilla')

@section('contenido')

<div class="content-wrapper">

    <section class ="content-header">
        <h1>Inicio</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ count($ventas) }}</h3>
                                <p>Ventas</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cart-plus"></i>
                            </div>
                            <a href="{{ url('Ver-Ventas') }}" class="small-box-footer">Ir a Ventas<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ count($libros) }}</h3>
                                <p>Libros</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="{{ url('Libros') }}" class="small-box-footer">Ir a Libros<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ count($clientes) }}</h3>
                                <p>Clientes</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="{{ url('Clientes') }}" class="small-box-footer">Ir a Clientes<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ count($pedidos) }}</h3>
                                <p>Pedidos en Camino</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cubes"></i>
                            </div>
                            <a href="{{ url('Pedidos') }}" class="small-box-footer">Ir a Pedidos<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <h2>Stock de Libros</h2>
                <table class="table table-bordered table-hover table-striped DT1">
                    <thead>
                        <tr>
                            <th>T&iacute;tulo</th>
                            <th>G&eacute;nero</th>
                            <th>Autor</th>
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
                                <td>{{ $libro->autor->nombre }}</td>
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
