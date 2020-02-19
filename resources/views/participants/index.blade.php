@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Participantes</h2>
            </div>
            <div class="pull-right">
                @can('participant-create')
                    <a class="btn btn-default" href="{{ route('participants.create') }}"> Formato</a>
                    <a class="btn btn-default" href="{{ route('participants.export')}}"> Exportar Participante</a>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalParticipants">Asignación masiva</button>
                    <a class="btn btn-success" href="{{ route('participants.create') }}"> Crear nuevo participante</a>
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
            <button type="button" class="close" data-dismiss="alert alert-label">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('Mensaje2')}}
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nro</th>
            <th>Dni</th>
            <th>Nombre Completos</th>
            <th>Cargo</th>
            <th>Area</th>
            <th>Gerencia</th>
            <th>Empresa</th>
            <th>Unidad Minera</th>
            <th>estado</th>
            <th nowrap>Acciones</th>
        </tr>
        @foreach ($data as $key => $user)
        <body>
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->document }}</td>
                <td>{{ $user->name }} {{ $user->last_name }}</td>
                <td>{{ $user->position }}</td>
                <td>{{ $user->area }}</td>
                <td>{{ $user->management }}</td>
                <td>{{ $user->company }}</td>
                <td>{{ $user->unity }}</td>
                <td>
                    @if($user->state == 1)
                        <span class="label bg-green">activo</span>
                    @else
                        <span class="label bg-red">desactivado</span>
                    @endif
                </td>
                <td nowrap>
                    @can('participant-list')
                        <a class="btn btn-info" href="{{ route('participants.show',$user->id) }}">Mostrar</a>
                    @endcan
                    @can('participant-edit')
                        <a class="btn btn-primary" href="{{ route('participants.edit',$user->id) }}">Editar</a>
                    @endcan
                    {!! Form::open(['method' => 'DELETE','route' => ['participants.destroy', $user->id],'style'=>'display:inline']) !!}
                    @can('participant-delete')
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    @endcan
                    {!! Form::close() !!}
                </td>
            </tr>
        </body>
        @endforeach
    </table>

    <div id="modalParticipants" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Registro masivo de participantes</h4>
                </div>
                <form action="{{ route('participants.import')}}" enctype="multipart/form-data" method="post" >
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="file_up">Asignacion Masiva</label>
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

{!! $data->render() !!}
@endsection
