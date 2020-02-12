@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Agregar Empresa</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('companies.index') }}"> Volver</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> Tienes problemas con tu input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Ruc:</label>
                    <input type="text" name="ruc" class="form-control" value="{{ $company->ruc }}" placeholder="Ingrese el Nro de RUC">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="name" class="form-control" value="{{ $company->name }}" placeholder="Ingrese razón social">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="form-group">
                    <label>Dirección:</label>
                    <input type="text" name="address" class="form-control" value="{{ $company->address }}" placeholder="Ingrese Dirección">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <label>telefono:</label>
                    <input type="text" name="phone" class="form-control" value="{{ $company->phone }}" placeholder="Ingrese Nro. de telefono">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </div>

    </form>
@stop
