@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')


<section class="content-header">

</section>

<section class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Inscription</h3>
        </div> 
        {!! Form::model($inscription, ['route' => ['inscriptions.update', $inscription->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        @include('Inscription.partials.form')
        {!! Form::close() !!}
      </div>         
    </div>
  </div>
</section> 



@stop