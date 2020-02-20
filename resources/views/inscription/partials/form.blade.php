



<div class="box-body">

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

        @csrf


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label('course_id', 'Curso') !!}
                    {!! Form::select('course_id', $courses, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('location_id', 'Lugar') !!}
                    {!! Form::select('location_id', $locations, null, ['class' => 'form-control selection-input']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('slot', 'Vacantes') !!}
                    {!! Form::text('slot', null, ['class' => 'form-control','placeholder' => 'Ingresa slots','required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', 'Facilitador') !!}
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group" >
                    {!! Form::label('start_date', 'Fecha') !!}
                    {!! Form::text('start_date', null, ['class' => 'form-control datepicker ','autocomplete' =>'off', 'placeholder' => 'Ingrese fecha','required' => 'required']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('time', 'Hora') !!}
                    {!! Form::text('time', null, ['class' => 'form-control timepicker ','placeholder' => 'Ingresa Hora','required' => 'required']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('address', 'Dirección') !!}
                    {!! Form::text('address', null, ['class' => 'form-control','placeholder' => 'Ingresa dirección','required' => 'required']) !!}
                </div>
                <button id= btnagregar type="submit" class="btn btn-primary btn_submit_register">Guardar</button>
            </div>

        </div>
