@extends('adminlte::page')
@section('title', 'Southern')

@section('content_header')
@stop


@section('content')
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar Tipo cursos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('type_courses.index') }}"> Volver</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipo Curso:</strong>
                {{ $type_course->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Estado:</strong>
                @if($type_course->state==1)
                    <label class="label label-primary">Activo</label>
                @else
                    <label class="label label-warning">Inactivo</label>
                @endif
            </div>
        </div>
    </div>
@stop