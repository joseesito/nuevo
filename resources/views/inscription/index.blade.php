<!DOCTYPE html>
@extends('adminlte::page')

@section('title', 'Souther')

@section('content_header')
@stop

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Programación de cursos</h2>
            </div>
            <div class="pull-right">
                @can('inscription-create')
                <a class="btn btn-success" href="{{ route('inscriptions.create') }}"> Crear nueva Programación</a>
                @endcan
            </div>
        </div>
    </div>


      @if(Session::has('Mensaje'))

          <div class="alert alert-success" role="alert">

          <strong font size=7 >Aviso: </strong> {{session('flash')}}
          <button type="button" class="close" data-dismiss="alert alert-label">
           <span aria-hidden="true">&times;</span>
          </button>

          {{ Session::get('Mensaje')}}
          </div>
      @endif


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>lugar</th>
            <th>Curso</th>
            <th>Fecha Inicio</th>
            <th>Hora</th>
            <th>Dirección</th>
            <th>Unidad</th>
            <th width="280px">Acciones</th>
        </tr>
	    @foreach ($inscriptions as $inscription)
	    <tr>
            <td>{{ $inscription->id }}</td>
            <td>{{ $inscription->location }}</td>
	        <td>{{ $inscription->name }}</td>
            <td>{{ $inscription->start_date}}</td>
            <td>{{ $inscription->hours }}</td>
            <td>{{ $inscription->address }}</td>
            <td>{{ $inscription->unity }}</td>
	        <td>
                <form action="{{ route('inscriptions.destroy',$inscription->id) }}" method="POST">
                    <a class="btn btn-info btn-sm" href="{{ route('inscriptions.show',$inscription->id) }}">Mostrar</a>
                    @can('inscription-edit')
                    <a class="btn btn-primary btn-sm" href="{{ route('inscriptions.edit',$inscription->id) }}">Editar</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('inscription-delete')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    @endcan
                    @can('inscription-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('inscriptions.register',$inscription->id) }}">Registrar</a>
                    @endcan
                    @can('inscription-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('inscriptions.edit',$inscription->id) }}">Subir Notas</a>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


@stop
