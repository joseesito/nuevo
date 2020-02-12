@extends('adminlte::page')

@section('title', 'Souther')

@section('content_header')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de empresas</h2>
            </div>
            <div class="pull-right">
                @can('course-create')
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Crear nueva Empresa</a>
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
            <th>Ruc</th>
            <th>Empresa</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
	    @foreach ($companies as $company)
	    <tr>
	        <td>{{ $company->ruc }}</td>
	        <td>{{ $company->name }}</td>
	        <td>{{ $company->address }}</td>
	        <td>{{ $company->phone }}</td>
            @if($company->state = 1)
                <td><span class="label bg-green">activo</span></td>
            @else
                <td><span class="label bg-yellow">Desactivado</span></td>
            @endif
	        <td>
                <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('companies.show',$company->id) }}">Mostrar</a>
                    @can('course-edit')
                        <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Editar</a>
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
