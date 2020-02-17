@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@endsection

@section('content')


<section class="content-header">

</section>

<section class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Programacón</h3>
        </div>
        {!! Form::model($inscription, ['route' => ['inscriptions.update', $inscription->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        @include('Inscription.partials.form')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection

@section('js')

    <script>
        $(function () {
            $('.datepicker').datetimepicker({
                locale: 'es',
                format: 'L'
            });

            $('.timepicker').datetimepicker({
                locale: 'es',
                format: 'HH:mm A'
            });
            $('.selection-input').select2();
        });

    </script>
@endsection
