@extends('plantilla')

@section('contenido')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Ventas Realizadas</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped DT1">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Cliente</td>
                            <td>Vendedor</td>
                            <td>Fecha</td>
                            <td>Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $venta->cliente->nombre }}</td>
                                <td>{{ $venta->vendedor->name }}</td>
                                <td>{{ $venta->fecha }}</td>
                                <td>{{ $venta->total }}</td>
                                <td>
                                    <a href="{{ url('Ver-Venta/'.$venta->id) }}">
                                        <button class="btn btn-success">Ver Venta</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection
