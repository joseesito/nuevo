@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@endsection

@section('content')

    <section class="content-header">

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Registar participantes a la programacion del curso {{ $inscription->name }}</h3>
                    </div>

                    {!! Form::open(['route' => 'inscriptions.store', 'class' => 'form-horizontal']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

@endsection
