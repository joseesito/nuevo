@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Curso {{ $inscription->name }} del {{ $inscription->start_date }} {{ $inscription->time }} </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('inscriptions.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    @include('partials.validation-errors')

    <form action="{{ route('inscriptions.register_save', $inscription->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-10">
                <div class="form-group">
                    <label for="id_users">Participantes:</label>
                    <select name="participants[]" class="form-control selection-input" multiple="multiple">
                        @foreach($participants as $participant)
                            <option value="{{ $participant->id }}">{{ $participant->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Registar</button>
            </div>
        </div>

    </form>

@endsection


@section('js')

    <script>
        $(document).ready(function () {
            $('.selection-input').select2({
                theme: "bootstrap",
                placeholder: "Selecciona los particpantes a inscribirse",
            });
        });
    </script>
@endsection
