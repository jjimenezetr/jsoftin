@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo rol</div>
                <div class="container">  
                    <br> 
                    <form method="POST" action="{{ route('actualizar_rol',encrypt($roles->id)) }}">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="rol">Nombre rol</label>
                            <input id="rol" type="text" class="form-control{{ $errors->has('rol') ? ' is-invalid' : '' }}" name="rol" value="{{$roles->rol}}" required autofocus>
                            @if ($errors->has('rol'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('rol') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a href="{{ route('listar_rol') }}" class="btn btn-danger">Volver</a>
                    </form>
                    <br>
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

        if('{{$error}}' == 'registrado'){
            jQuery(document).ready(function(){
                swal("Editado", "El rol ha sido cambiado correctamente", "success");
            });
        }else{
            if('{{$error}}' == 'duplicado'){
                jQuery(document).ready(function(){
                    swal("Error!!", "El rol ingresado ya esta registrado", "error");  
                });
            }
        }
    </script>
@endsection



