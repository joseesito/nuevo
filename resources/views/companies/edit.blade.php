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

    <form action="{{ route('companies.update', $company->id) }}" method="POST" id="form_Inscription">
        @method('PUT')
        @include('companies._form', ['btnText' => 'Actualizar'])
    </form>
@endsection
@section('js')
<script>
$('#form_Inscription').submit(function()
{
    $('.btn_submit_register').prop('disabled',true);
    $('.btn_submit_register').html('<p><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only"></span> Actualizando...</p>');
});
</script>
@endsection