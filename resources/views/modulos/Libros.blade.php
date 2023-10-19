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
                            <th>Autor</th>
                            <th>Sinopsis</th>
                            <th>Idioma</th>
                            <th>Portada</th>
                            <th>Fecha de Publicaci&oacute;n</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th></th>
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

                                <td>
                                    <a href="{{ url('Editar-Libro/'.$libro->id) }}">
                                        <button class="btn btn-success">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger QuitarLibro" Lid="{{ $libro->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="AgregarLibro">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">

                @csrf
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <h2>T&iacute;tulo:</h2>
                            <input type="text" class="form-control input-lg" name="titulo" required="">
                        </div>

                        <div class="form-group">
                            <h2>G&eacute;nero:</h2>
                            <select class="form-control input-lg" name="id_genero" required="">
                                <option value="">Seleccionar...</option>
                                @foreach ($generos as $genero)
                                    <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Autor:</h2>
                            <select class="form-control input-lg" name="id_autor" required="">
                                <option value="">Seleccionar...</option>
                                @foreach ($autores as $autor)
                                    <option value="{{$autor->id}}">{{$autor->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Sinopsis:</h2>
                            <textarea class="form-control" name="sinopsis" style="height: 100px" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <h2>Idioma:</h2>
                            <input type="text" class="form-control input-lg" name="idioma" required="">
                        </div>

                        <div class="form-group">
                            <h2>Portada:</h2>
                            <input type="file" class="form-control input-lg" name="portada" required="">
                        </div>

                        <div class="form-group">
                            <h2>Fecha de Publicaci&oacute;n:</h2>
                            <input type="date" class="form-control input-lg" name="fecha" required="">
                        </div>

                        <div class="form-group">
                            <h2>Stock:</h2>
                            <input type="number" class="form-control input-lg" name="stock" required="">
                        </div>

                        <div class="form-group">
                            <h2>Precio:</h2>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control input-lg" name="precio" required="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(isset($sinopsis))
<div class="modal fade" id="Sinopsis">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2>Sinopsis:</h2>
                <p>{{$sinopsis->sinopsis}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(isset($libroEditar))
<div class="modal fade" id="EditarLibro">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="{{ url('Actualizar-Libro/'.$libroEditar->id) }}">

                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <h2>T&iacute;tulo:</h2>
                            <input type="text" class="form-control input-lg" name="titulo" required="" value="{{$libroEditar->titulo}}">
                        </div>

                        <div class="form-group">
                            <h2>G&eacute;nero:</h2>
                            <select class="form-control input-lg" name="id_genero" required="">
                                <option value="{{$libroEditar->id_genero}}">{{$libroEditar->genero->nombre}}</option>
                                @foreach ($generos as $genero)
                                    <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Autor:</h2>
                            <select class="form-control input-lg" name="id_autor" required="">
                                <option value="{{$libroEditar->id_autor}}">{{$libroEditar->autor->nombre}}</option>
                                @foreach ($autores as $autor)
                                    <option value="{{$autor->id}}">{{$autor->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Sinopsis:</h2>
                            <textarea class="form-control" name="sinopsis" style="height: 100px" required="">{{$libroEditar->sinopsis}}</textarea>
                        </div>

                        <div class="form-group">
                            <h2>Idioma:</h2>
                            <input type="text" class="form-control input-lg" name="idioma" required="" value="{{$libroEditar->idioma}}">
                        </div>

                        <div class="form-group">
                            <h2>Portada:</h2>
                            <input type="file" class="form-control input-lg" name="portadaN" required="">
                            <img src="{{ url('storage/'.$libroEditar->portada) }}" width="300px">
                        </div>

                        <div class="form-group">
                            <h2>Fecha de Publicaci&oacute;n:</h2>
                            <input type="date" class="form-control input-lg" name="fecha" required="" value="{{$libroEditar->fecha}}">
                        </div>

                        <div class="form-group">
                            <h2>Stock:</h2>
                            <input type="number" class="form-control input-lg" name="stock" required="" value="{{$libroEditar->stock}}">
                        </div>

                        <div class="form-group">
                            <h2>Precio:</h2>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control input-lg" name="precio" required="" value="{{$libroEditar->precio}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection
