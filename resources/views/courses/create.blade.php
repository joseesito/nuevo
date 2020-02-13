@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Agregar Curso</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('courses.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    @include('partials.validation-errors')

    <form action="{{ route('courses.store') }}" method="POST">
        @include('courses._form', ['btnText' => 'Guardar'])
    </form>

@endsection
