@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Unidad</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('unities.index') }}"> Volver</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> Hay problemas con tu input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('unities.update',$unity->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nombre:</strong>
		            <input type="text" name="name" value="{{ $unity->name }}" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Editar</button>
		    </div>
		</div>

    </form>

@stop
