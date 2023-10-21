@extends('plantilla')

@section('contenido')

<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <div class="col-md-4">
                <h3>Gestionar la Venta ID: {{ $venta->id }}</h3>

                <h4>Vendedor: <br> {{$vendedor->name}} </h4>
                <h4>Cliente: <br> {{$cliente->nombre}} </h4>
                <h4>Fecha: <br> {{$venta->fecha}} </h4>
                <h4>Total: <br> {{$precio}} </h4>

                <br>

                <form method="post" action="{{ url('Finalizar-Venta') }}">

                    @csrf
                    <input type="hidden" name="id" value="{{ $venta->id }}">
                    <input type="hidden" name="total" value="{{ $precio }}">
                    <button type="submit" class="btn btn-success">Finalizar Venta</button>
                </form>
            </div>
            <div class="col-md-8 bg-success">
                <table class="table table-bordered table-hover table-striped DT1">
                    <thead>
                        <tr>
                            <th>T&iacute;tulo</th>
                            <th>G&eacute;nero</th>
                            <th>Autor</th>
                            <th>Portada</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libros as $libro)
                            @if($libro->stock > 0)
                                <tr>
                                    <td>{{ $libro->titulo }}</td>
                                    <td>{{ $libro->genero->nombre }}</td>
                                    <td>{{ $libro->autor->nombre }}</td>
                                    <td><img src="{{ url('storage/'.$libro->portada) }}" width="50px"></td>
                                    @if($libro->stock < 10 && $libro->stock > 5)
                                        <td>
                                            <button class="btn btn-warning">{{$libro->stock}}</button>
                                        </td>
                                    @elseif ($libro->stock <= 5)
                                        <td>
                                            <button class="btn btn-danger">{{$libro->stock}}</button>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-sucess">{{$libro->stock}}</button>
                                        </td>
                                    @endif

                                    <td>{{ $libro->precio }}</td>
                                    <td>
                                        <form method="post">

                                            @csrf
                                            <input type="hidden" name="id_venta" value="{{$venta->id}}">
                                            <input type="hidden" name="id_libro" value="{{$libro->id}}">
                                            <input type="hidden" name="precio" value="{{$libro->precio}}">
                                            <input type="hidden" name="stock" value="{{$libro->stock}}">
                                            <button type="submit" class="btn btn-success">Agregar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped DT1">
                    <thead>
                        <tr>
                            <th>Libro</th>
                            <th>Autor</th>
                            <th>Portada</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($librosVenta as $lv)
                            @foreach ($libros as $libro)
                                @if ($libro->id == $lv->id_libro)
                                    <tr>
                                        <td>{{ $libro->titulo }}</td>
                                        <td>{{ $libro->autor->nombre }}</td>
                                        <td><img src="{{ url('storage/'.$libro->portada) }}" width="50px"></td>
                                        <td>{{ $libro->precio }}</td>
                                        <td>
                                            <form method="post" action="{{ url('Quitar-Libro-Venta/'.$venta->id) }}">

                                                @csrf
                                                <input type="hidden" name="id" value="{{ $lv->id }}">
                                                <input type="hidden" name="id_libro" value="{{ $libro->id }}">
                                                <input type="hidden" name="stock" value="{{ $libro->stock }}">

                                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        @endforeach
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection
