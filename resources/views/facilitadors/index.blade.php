@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administrar Facilitadores</h2>
            </div>
            <div class="pull-right">
                @can('facilitador-create')
                    <a class="btn btn-success" href="{{ route('facilitadors.create') }}"> Crear nuevo Facilitador</a>
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
            <th>Nombre Completos</th>
            <th>Apellido</th>
            <th>Documento</th>
            <th>Estado</th>
            <th>Email</th>
            <th nowrap>Actionn</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->document }}</td>
                @if($user->state==1)
                <td>
                <label class="label label-primary">Activo</label>
                </td>
                @else
                <td>
                <label class="label label-warning">Inactivo</label>
                </td>
                @endif
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td nowrap>
                    @can('facilitador-list')
                        <a class="btn btn-info" href="{{ route('facilitadors.show',$user->id) }}">Mostrar</a>
                    @endcan
                    @can('facilitador-edit')
                        <a class="btn btn-primary" href="{{ route('facilitadors.edit',$user->id) }}">Editar</a>
                    @endcan
                    {!! Form::open(['method' => 'DELETE','route' => ['facilitadors.destroy', $user->id],'style'=>'display:inline']) !!}
                    @can('facilitador-delete')
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    @endcan
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>



{!! $data->render() !!}
@section('js')


    @endsection



@stop
