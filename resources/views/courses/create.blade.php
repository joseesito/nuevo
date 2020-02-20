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
                <a class="btn btn-primary " href="{{ route('courses.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    @include('partials.validation-errors')

    <form action="{{ route('courses.store') }}" id="form_Inscription" method="POST">
        @include('courses._form', ['btnText' => 'Guardar'])
    </form>

@endsection
@section('js')
<script>
$('#form_Inscription').submit(function()
{
    $('.btn_submit_register').prop('disabled',true);
    $('.btn_submit_register').html('<p><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only"></span> Agregando...</p>');
});
</script>
@endsection