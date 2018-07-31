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
                            <td><button type="button" name="{{$rol->id}}" id="{{$rol->id}}" class="btn btn-primary">Editar</button></td>
                            <td><button type="button" name="{{$rol->id}}" id="{{$rol->id}}" class="btn btn-danger">Eliminar</button></td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




