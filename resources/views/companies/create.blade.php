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

    @include('partials.validation-errors')

    <form action="{{ route('companies.store') }}" method="POST" id="form_Inscription">
        @include('companies._form', ['btnText' => 'Guardar'])
    </form>
@stop
@section('js')
<script>
$('#form_Inscription').submit(function()
{
    $('.btn_submit_register').prop('disabled',true);
    $('.btn_submit_register').html('<p><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only"></span> Agregando...</p>');
});
</script>
@endsection