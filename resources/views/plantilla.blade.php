<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Librer&iacute;a</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- DateTable -->
  <link rel="stylesheet" href="http://sistemalibrerias.test/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini login-page">

    @if(Auth::user())

    <div class="wrapper">

        @include('modulos.cabecera')

        @if(auth()->user()->rol == "Vendedor")
            @include('modulos.menuV')
        @else
            @include('modulos.menu')
        @endif

        @yield('contenido')

    </div>

    @else

        @yield('content')

    @endif
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="http://sistemalibrerias.test/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="http://sistemalibrerias.test/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="http://sistemalibrerias.test/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="http://sistemalibrerias.test/bower_components/raphael/raphael.min.js"></script>
<script src="http://sistemalibrerias.test/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="http://sistemalibrerias.test/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="http://sistemalibrerias.test/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="http://sistemalibrerias.test/bower_components/moment/min/moment.min.js"></script>
<script src="http://sistemalibrerias.test/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="http://sistemalibrerias.test/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="http://sistemalibrerias.test/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="http://sistemalibrerias.test/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="http://sistemalibrerias.test/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="http://sistemalibrerias.test/dist/js/pages/dashboard.js"></script>

<!-- DateTable -->
<script src="http://sistemalibrerias.test/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="http://sistemalibrerias.test/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="http://sistemalibrerias.test/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.sidebar-menu').tree();

    $(".DT1").DataTable({

        "language": {

        "sSearch": "Buscar:",
        "sEmptyTable": "No hay datos en la Tabla",
        "sZeroRecords": "No se encontraron resultados",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total _TOTAL_",
        "SInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrando de un total de _MAX_ registros)",
        "oPaginate": {

            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"

        },

        "sLoadingRecords": "Cargando...",
        "sLengthMenu": "Mostrar _MENU_ registros"

        }
    });

    $('.table').on('click', '.EliminarUsuario', function(){
        let Uid = $(this).attr('Uid');
        let Usuario = $(this).attr('Usuario');

        Swal.fire({
            title: '¿Seguro que desea eliminar el Usuario: ' + Usuario + '?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if(result.isConfirmed){
                window.location = 'Eliminar-Usuario/' + Uid;
            }
        })
    })

    $('.table').on('click', '.EliminarCliente', function(){
        let Cid = $(this).attr('Cid');
        let Cliente = $(this).attr('Cliente');

        Swal.fire({
            title: '¿Seguro que desea eliminar el Cliente: ' + Cliente + '?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if(result.isConfirmed){
                window.location = 'Eliminar-Cliente/' + Cid;
            }
        })
    })

    $('.table').on('click', '.QuitarLibro', function(){
        let Lid = $(this).attr('Lid');

        Swal.fire({
            title: '¿Seguro que desea quitar este libro?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if(result.isConfirmed){
                window.location = 'Eliminar-Libro/' + Lid;
            }
        })
    })

</script>

@if(session('UsuarioCreado') == 'OK')
    <script>
        Swal.fire(
            'El Usuario ha sido creado',
            '',
            'success'
            )
    </script>
@endif

@if(session('ClienteCreado') == 'OK')
    <script>
        Swal.fire(
            'El Cliente ha sido creado',
            '',
            'success'
            )
    </script>
@endif

@if(session('AutorCreado') == 'OK')
    <script>
        Swal.fire(
            'El Autor ha sido registrado',
            '',
            'success'
            )
    </script>
@endif

@if(session('LibroCreado') == 'OK')
    <script>
        Swal.fire(
            'El Libro ha sido agregado',
            '',
            'success'
            )
    </script>
@endif

<?php
    $exp = explode('/', $_SERVER["REQUEST_URI"]);
?>
@if(isset($exp[1]))
    @if($exp[1] == 'Editar-Usuario')

        <script>
            $(document).ready(function(){
                $('#EditarUsuario').modal('toggle');
            })
        </script>

    @elseif($exp[1] == 'Editar-Cliente')

        <script>
            $(document).ready(function(){
                $('#EditarCliente').modal('toggle');
            })
        </script>

    @elseif($exp[1] == 'Libro-Sinopsis')

    <script>
        $(document).ready(function(){
            $('#Sinopsis').modal('toggle');
        })
    </script>

    @elseif($exp[1] == 'Editar-Libro')

    <script>
        $(document).ready(function(){
            $('#EditarLibro').modal('toggle');
        })
    </script>

    @endif
@endif

</body>
</html>
