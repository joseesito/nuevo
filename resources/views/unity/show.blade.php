@extends('adminlte::page')
@section('title', 'Southern')

@section('content_header')
@stop


@section('content')
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar Unidad Minera</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('unities.index') }}"> Volver</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipo Curso:</strong>
                {{ $unity->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Estado:</strong>
                @if($unity->state = 1)
                    <span class="label bg-green">activo</span>
                @else
                    <span class="label bg-yellow">Desactivado</span>
                @endif
            </div>
        </div>
    </div>
@stop
