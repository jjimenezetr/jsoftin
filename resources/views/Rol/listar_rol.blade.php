@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de roles</div>
                <div class="container">  
                    <br> 
                    <a href="{{ route('form_rol') }}" class="btn btn-success">Nuevo</a>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>N°</th>
                            <th>Nombre rol</th>
                            <th>Fecha de registro</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $cont = 0;
                        ?>
                        @foreach($roles as $rol)
                        <?php  $cont++; ?>
                          <tr>
                            <td>{{$cont}}</td>
                            <td>{{$rol->rol}}</td>
                            <td>{{$rol->created_at}}</td>
                            <td> <a class="btn btn-primary" href="{{ route('editar_rol',$rol->id) }}">Editar</a> </td>
                            <td>
                               <!-- <a class="btn btn-danger" href="{{ route('eliminar_rol',$rol->id) }}">Eliminar</a> -->
                            <button class="btn btn-danger" value="Eliminarr" onclick="eliminar({{$rol->id}}) , listar()"> Eliminar</button>  </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    <link href="{{ asset('alertas/css/sweetalert.css') }}" rel="stylesheet">

   
    <script src="{{ asset('alertas/js/sweetalert.min.js') }}" defer></script>
    <script src="{{ asset('alertas/js/functions.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript">


    jQuery(document).ready(function(){
       // $(location).attr('href', "{{ route('listar_rol') }}");
       $a = 0;
    }); 

        function eliminar(id){
   
            jQuery(document).ready(function(){

                swal({   
                    title: "¿Seguro que deseas eliminar?",   
                    text: "No podrás deshacer este paso",   
                    type: "warning",   
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Aceptar",   
                    closeOnConfirm: false }, 

                    function(){   
                        
                        swal({   
                            title: "Eliminado correctamente",   
                            text: "Se cerrará en 1 segundos.",   
                            timer: 700,   
                            showConfirmButton: false 
                        });
                        
                        $(location).attr('href', "{{ route('eliminar_rol',$rol->id) }}");
                        //$(location).attr('href', "{{ route('listar_rol') }}");
                        //window.history.pushState(data, "Titulo", "{{ route('listar_rol') }}");
                        //$("#enlace").click();
                        //window.location = $('#enlace').attr('href');
                        $a = 0;
                });
            });  
  
        }
        function listar(){
          
           //window.history.pushState(data, "Titulo", "{{ route('listar_rol') }}");
           //$(location).attr('href', "{{ route('listar_rol') }}")
        }

    </script>

@endsection




