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
              <h3 class="box-title">Registrar Inscription</h3>
            </div>
            {!! Form::open(['route' => 'inscriptions.store','id'=>'form_Inscription', 'id'=>'form_Inscription','class' => 'form-horizontal']) !!}
                @include('Inscription.partials.form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </section>

@endsection

@section('js')

    <script>
        $(document).ready(function () {
            $('.datepicker').datetimepicker({
                locale: 'es',
                format: 'L'
            });

            $('.timepicker').datetimepicker({
                locale: 'es',
                format: 'HH:mm A'
            });
            $('.selection-input').select2({
                theme: "bootstrap"
            });
            $('#form_Inscription').submit(function()
            {
            $('.btn_submit_register').prop('disabled',true);
            $('.btn_submit_register').html('<p><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only"></span> Registrando...</p>');
            });
        });
    </script>
@endsection
