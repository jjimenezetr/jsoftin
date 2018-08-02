@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo usuario</div>
                <div class="container">  
                    <br> 
                    <form method="POST" action="{{ route('nuevo_usuario') }}">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contrasena</label>
                            <input id="contrasena" type="text" class="form-control{{ $errors->has('contrasena') ? ' is-invalid' : '' }}" name="contrasena" value="" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <input id="rol" type="text" class="form-control{{ $errors->has('rol') ? ' is-invalid' : '' }}" name="rol" value="" required autofocus>
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
@endsection



