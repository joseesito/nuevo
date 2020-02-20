@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Tipo Curso</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('type_courses.index') }}"> Volver</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> Hay problemas con tu input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('type_courses.update',$type_course->id) }}" id="form_Inscription" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nombre:</strong>
		            <input type="text" name="name" value="{{ $type_course->name }}" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary btn_submit_register">Editar</button>
		    </div>
		</div>


    </form>

@stop
@section('js')
<script>
$('#form_Inscription').submit(function()
{
    $('.btn_submit_register').prop('disabled',true);
    $('.btn_submit_register').html('<p><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only"></span> Actualizando...</p>');
});
</script>
@endsection