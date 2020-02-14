@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar nuevo Participante</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('participants.index') }}"> Volver</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> esta mal su input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model($user, ['method' => 'PATCH','route' => ['participants.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-3">
        <div class="form-group">
            <strong>DNI/Documento:</strong>
            {!! Form::text('document', null, array('placeholder' => 'Ingrese el numero de documento','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="form-group">
            <strong>Nombres:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Ingrese Nombres','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-5">
        <div class="form-group">
            <strong>Apellidos:</strong>
            {!! Form::text('last_name', null, array('placeholder' => 'Ingrese apellidos','class' => 'form-control')) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Cargo/Ocupación:</strong>
            {!! Form::text('position', null, array('placeholder' => 'Ingrese el cargo u ocupación','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Area</strong>
            {!! Form::text('area', null, array('placeholder' => 'Ingrese el area','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Gerencia:</strong>
            {!! Form::text('management', null, array('placeholder' => 'Ingrese la gerencia','class' => 'form-control')) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Empresa:</strong>
            {!! Form::select('company_id', $company, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Unidad Minera:</strong>
            {!! Form::select('unity_id', $unity, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</div>

{!! Form::close() !!}
@stop
