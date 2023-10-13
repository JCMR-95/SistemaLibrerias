@extends('plantilla')

@section('contenido')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Clientes</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#CrearCliente">Crear Nuevo Cliente</button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped DT1">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Documento</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cli)
                            <tr>
                                <td>{{ $cli->nombre }}</td>
                                <td>{{ $cli->documento }}</td>
                                <td>{{ $cli->fechaNac }}</td>
                                <td>{{ $cli->direccion }}</td>
                                <td>{{ $cli->telefono }}</td>
                                <td>
                                    <a href="{{ url('Editar-Cliente/'.$cli->id) }}">
                                        <button class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                    </a>

                                    <button type="button" class="btn btn-danger EliminarCliente" Cid="{{$cli->id}}" Cliente="{{$cli->nombre}}" data-dismiss="modal"><i class="fa fa-trash"></i></button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="CrearCliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">

                @csrf
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <h2>Nombre:</h2>
                            <input type="text" class="form-control input-lg" name="nombre" required="">
                        </div>
                        <div class="form-group">
                            <h2>Documento:</h2>
                            <input type="text" class="form-control input-lg" name="documento" required="">
                        </div>
                        <div class="form-group">
                            <h2>Fecha de Nacimiento:</h2>
                            <input type="date" class="form-control input-lg" name="fechaNac" required="">
                        </div>
                        <div class="form-group">
                            <h2>Direcci&oacute;n:</h2>
                            <input type="text" class="form-control input-lg" name="direccion" required="">
                        </div>
                        <div class="form-group">
                            <h2>Tel&eacute;fono:</h2>
                            <input type="text" class="form-control input-lg" name="telefono" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(isset($cliente))
    <div class="modal fade" id="EditarCliente">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('actualizar-Cliente/'.$cliente->id) }}">

                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <h2>Nombre:</h2>
                                <input type="text" class="form-control input-lg" name="nombre" value={{ $cliente->nombre }} required="">
                            </div>
                            <div class="form-group">
                                <h2>Documento:</h2>
                                <input type="text" class="form-control input-lg" name="documento" value={{ $cliente->documento }} required="">
                            </div>
                            <div class="form-group">
                                <h2>Fecha de Nacimiento:</h2>
                                <input type="date" class="form-control input-lg" name="fechaNac" value={{ $cliente->fechaNac }} required="">
                            </div>
                            <div class="form-group">
                                <h2>Direcci&oacute;n:</h2>
                                <input type="text" class="form-control input-lg" name="direccion" value={{ $cliente->direccion }} required="">
                            </div>
                            <div class="form-group">
                                <h2>Tel&eacute;fono:</h2>
                                <input type="text" class="form-control input-lg" name="telefono" value={{ $cliente->telefono }} required="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@endsection
