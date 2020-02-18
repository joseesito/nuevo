@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Curso {{ $inscription->name }} del {{ $inscription->start_date }} {{ $inscription->time }} </h2>
            </div>
            <div class="pull-right">
                @can('participant-create')
                    <a class="btn btn-default" href="{{ route('inscriptions.export', $inscription->id) }}"> Exportar</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalParticipants"> Subir notas</button>
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

    <table class="table table-bordered">
        <tr>
            <th>Nro</th>
            <th>Dni</th>
            <th>Nombre Completos</th>
            <th>Empresa</th>
            <th>estado</th>
            <th>nota</th>
            <th>Acciones</th>
        </tr>
        @foreach ($participants as $participant)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $participant->document }}</td>
                <td>{{ $participant->full_name }}</td>
                <td>{{ $participant->company }}</td>
                <td>
                    @if($participant->state == 1)
                        <span class="label bg-green">activo</span>
                    @else
                        <span class="label bg-red">desactivado</span>
                    @endif
                </td>
                <td>{{ $participant->grade }}</td>
                <td>
                {!! Form::open(['method' => 'DELETE','route' => ['participants.destroy', $participant->id],'style'=>'display:inline']) !!}
                @can('participant-delete')
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    @endcan
                {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    <div id="modalParticipants" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <form action="{{ route('participants.edit', ['id' => Request::segment(2)]) }}" enctype="multipart/form-data" method="post" >
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="file_up">Archivo</label>
                            <input id="file_up" name="file_up" type="file" accept=".xlsx">
                            <p class="help-block">Subir archivos con formato .xlsx</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-light-blue btn-sm">Cargar</button>
                    </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
