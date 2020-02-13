@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@endsection

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

    @include('partials.validation-errors')

    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @method('PUT')
        @include('companies._form', ['btnText' => 'Actualizar'])
    </form>
@endsection
