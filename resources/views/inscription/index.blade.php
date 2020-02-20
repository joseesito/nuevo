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

        @if(Session::has('Mensaje2'))

            <div class="alert alert-danger" role="alert">

            <strong font size=7 >Aviso: </strong> {{session('flash')}}
            <button type="button" class="close" data-dismiss="alert alert-label" >
            <span aria-hidden="true">&times;</span>
            </button>

        {{ Session::get('Mensaje2')}}
            </div>
        @endif


    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>
                <th>id</th>
                <th>lugar</th>
                <th>Curso</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Dirección</th>
                <th>Unidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($inscriptions as $inscription)
            <tr>
                <td>{{ $inscription->id }}</td>
                <td>{{ $inscription->location }}</td>
                <td>{{ $inscription->name }}</td>
                <td>{{ $inscription->start_date }}</td>
                <td>{{ $inscription->time }}</td>
                <td>{{ $inscription->address }}</td>
                <td>{{ $inscription->unity }}</td>
                <td nowrap>
                    <form action="{{ route('inscriptions.destroy',$inscription->id) }}" method="POST">
                        @can('inscription-edit')
                        <a class="btn btn-warning btn-sm" href="{{ route('inscriptions.edit',$inscription->id) }}"><i class="fa fa-pencil-square"></i></a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('inscription-delete')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        @endcan
                        @can('inscription-edit')
                            <a class="btn btn-default btn-sm" href="{{ route('inscriptions.register',$inscription->id) }}"><i class="fa fa-registered"></i></a>
                        @endcan
                        @can('inscription-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('inscriptions.grade',$inscription->id) }}"><i class="fa fa-file"></i></a>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable({
                "stateSave": true,
                "processing": true,
                "language" : {
                    "info": "_TOTAL_ registros",
                    "search": "Buscar",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior",
                    },
                    "lengthMenu": 'Mostrar <select>' +
                        '<option value="10">10</option>' +
                        '<option value="25">25</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todos</option>' +
                        '</select> registros',

                }
            });
        });
    </script>
@endsection
