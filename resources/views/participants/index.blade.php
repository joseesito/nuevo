@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Usuarios Administrar</h2>
            </div>
            <div class="pull-right">
                @can('user-create')
                    <a class="btn btn-success" href="{{ route('participants.create') }}"> Crear nuevo User</a>
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
            <th>Cargo</th>
            <th>Area</th>

            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Actionn</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->position }}</td>
                <td>{{ $user->area }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    @can('user-list')
                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Mostrar</a>
                    @endcan
                    @can('user-edit')
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
                    @endcan
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    @can('user-delete')
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    @endcan
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>



{!! $data->render() !!}
@stop
