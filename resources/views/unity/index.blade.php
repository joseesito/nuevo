@extends('adminlte::page')

@section('title', 'Souther')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>UNIDADES MINERAS</h2>
            </div>
            <div class="pull-right">
                @can('course-create')
                <a class="btn btn-success" href="{{ route('unities.create') }}"> Crear nueva UM</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Nombre</th>
            <th width="280px">Acciones</th>
        </tr>
	    @foreach ($unities as $unity)
	    <tr>

	        <td>{{ $unity->name }}</td>
	        <td>
                <form action="{{ route('unities.destroy',$unity->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('unities.show',$unity->id) }}">Mostrar</a>
                    @can('course-edit')
                    <a class="btn btn-primary" href="{{ route('unities.edit',$unity->id) }}">Editar</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('course-delete')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>




@stop
