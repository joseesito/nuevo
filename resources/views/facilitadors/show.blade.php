@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Mostrar Facilitadores</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('facilitadors.index') }}"> Regresar</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            {{ $user->nameuser }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Apellidos:</strong>
            {{ $user->lastname }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Company:</strong>
            {{ $user->companyname }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Unidad:</strong>
            {{ $user->unityname }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Documento:</strong>
            {{ $user->document }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Estado:</strong>
            @if($user->state==1)
           <label class="label label-primary">Activo</label>
           @else
           <label class="label label-warning">Inactivo</label>
           @endif
        </div>
    </div>
</div>
@stop