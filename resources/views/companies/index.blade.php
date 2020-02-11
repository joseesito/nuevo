@extends('adminlte::page')

@section('title', 'Souther')

@section('content_header')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tippo cursos</h2>
            </div>
            <div class="pull-right">
                @can('course-create')
                <a class="btn btn-success" href="{{ route('type_courses.create') }}"> Crear nuevo Curso</a>
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
            <th>Tipo Curso</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($type_course as $type_cours)
	    <tr>

	        <td>{{ $type_cours->name }}</td>
	        <td>
                <form action="{{ route('type_courses.destroy',$type_cours->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('type_courses.show',$type_cours->id) }}">Mostrar</a>
                    @can('course-edit')
                    <a class="btn btn-primary" href="{{ route('type_courses.edit',$type_cours->id) }}">Editar</a>
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
@endsection
