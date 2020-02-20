@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')

@endsection

@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Agregar Unidad Minera</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('unities.index') }}"> Volver</a>
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


    <form action="{{ route('unities.store') }}" id="form_Inscription" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nombre:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Nombre de la UM">
		        </div>
		    </div>
            <div class="text-center">
		            <button type="submit" class="btn btn-primary btn_submit_register">Agregar</button>
		    </div>
        </div>
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