@extends('plantilla')

@section('contenido')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestionar el Pedido ID: {{ $pedido->id }}</h1>

        <h4>Fecha de Env&iacute;o: {{ $pedido->fecha_envio }}</h4>
        <h4>Fecha de Entrega: {{ $pedido->fecha_entrega }}</h4>

        @if ($pedido->estado == 'Solicitado')
            <h3>Estado Actual: <button class="btn btn-primary">Solicitado</button>
                <br>

                <form method="post" action="{{ url('CambEstadoPed/'.$pedido->id) }}">

                    @csrf
                    Cambiar a: <button class="btn btn-warning" type="submit">En Camino</button>
                </form>
            </h3>

        @elseif($pedido->estado == 'En Camino')
            <h3>Estado Actual: <button class="btn btn-warning">En Camino</button>
                <br>

                <form method="post" action="{{ url('CambEstadoPed/'.$pedido->id) }}">

                    @csrf
                    Cambiar a: <button class="btn btn-success" type="submit">Recibido</button>
                </form>
            </h3>
        @else
            <h3>Estado Actual: <button class="btn btn-success">Recibido</button></h3>
        @endif
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                @if($pedido->estado != 'Recibido')

                    <h2>Agregar Libros al Pedido:</h2>
                    <h4>Registrados:</h4>

                    <form method="post">

                        @csrf
                        <div class="col-md-3">
                            <select name="id_libro" id="select2" required="">
                                <option value="">Elegir...</option>

                                @foreach ($libros as $libro)
                                    <option value="{{ $libro->id }}">{{ $libro->titulo }} - {{ $libro->autor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="cantidad" min="1" placeholder="Cantidad">
                        </div>

                        <button type="submit" class="btn btn-primary">Agregar al Pedido</button>
                    </form>

                @endif

                <table class="table table-bordered table-hover table-striped DT1">
                    <thead>
                        <tr>
                            <th>T&iacute;tulo</th>
                            <th>G&eacute;nero</th>
                            <th>Autor</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($librosP as $lp)
                            @foreach ($libros as $libro)
                                @if($lp->id_libro == $libro->id)
                                    <tr>
                                        <td>{{ $libro->titulo }}</td>
                                        <td>{{ $libro->genero->nombre }}</td>
                                        <td>{{ $libro->autor->name }}</td>
                                        <td>{{ $lp->cantidad }}</td>

                                        @if($pedido->estado != "Recibido")
                                            <td>
                                                <form method="post" action="{{ url('LibroP-Quitar/'.$pedido->id) }}">

                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{ $lp->id }}">
                                                    <input type="hidden" name="cantidad" value="{{ $lp->cantidad }}">
                                                    <button class="btn btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                                </form>
                                            </td>
                                        @elseif($pedido->estado == "Recibido" && $lp->estado == "")
                                            <td>
                                                <form method="post" action="{{ url('Verificar/'.$pedido->id) }}">

                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id_libro" value="{{ $libro->id }}">
                                                    <input type="hidden" name="cantidad" value="{{ $lp->cantidad }}">
                                                    <input type="hidden" name="id_lp" value="{{ $lp->id }}">
                                                    <button class="btn btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                                </form>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="box-body">


            </div>
        </div>
    </section>
</div>

@endsection
