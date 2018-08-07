@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar usuario</div>
                <div class="container">  
                    <br> 
                    <form method="POST" action="{{ route('actualizar_usuario',encrypt($id)) }}">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario', $usuario) }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contrasena</label>
                            <input id="contrasena" type="password"  disabled=”disabled”  class="form-control{{ $errors->has('contrasena') ? ' is-invalid' : '' }}" name="contrasena" value="{{ old('contrasena',$contrasena)}}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email',$email) }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control selectpicker"  name ="id_rol" id="id_rol">
                                @foreach ($roles as $rol)   
                                    @if($rol->id==$id_rol)
                                       <option value="{{$rol->id}}" selected >{{$rol->rol}}</option>
                                    @else
                                       <option value="{{$rol->id}}">{{$rol->rol}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a href="{{ route('lista_usuario') }}" class="btn btn-danger">Volver</a>
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
                swal("Editado", "El usuario ha sido cambiado correctamente", "success");
            });
        }else{
            if('{{$error}}' != ''){
                jQuery(document).ready(function(){
                    swal("Error!!", "{{$error}}", "error");  
                });
            }
        }
    </script>

@endsection



