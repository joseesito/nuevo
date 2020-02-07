@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Agregar Tipo de Curso</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('type_courses.index') }}"> Volver</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> Tienes problemas con tu input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('type_courses.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nombre:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
            <div class="text-center">
		            <button type="submit" class="btn btn-primary">Agregar</button>
		    </div>
        </div>
		    
    </form>
@stop