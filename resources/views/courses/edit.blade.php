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
          <h3 class="box-title">Editar Curso</h3>
        </div> 
        {!! Form::model($course, ['route' => ['courses.update', $course->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        @include('courses.partials.form')
        {!! Form::close() !!}
      </div>         
    </div>
  </div>
</section> 



@stop