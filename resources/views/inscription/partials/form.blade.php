



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

    <form action="{{ route('inscriptions.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
                {!! Form::label('course_id', 'Curso') !!}
                {!! Form::select('course_id', $courses, null, ['class' => 'form-control']) !!}		        
                </div>
                <div class="form-group">
                {!! Form::label('location_id', 'Lugar') !!}
                    {!! Form::select('location_id', $locations, null, ['class' => 'form-control']) !!}
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
			        {!! Form::text('start_date', null, ['class' => 'form-control datepicker ','autocomplete' =>'off', 'placeholder' => 'Ingresa fecha','required' => 'required']) !!}
                </div>
                <div class="form-group" >
                {!! Form::label('time', 'Hora') !!}
			        {!! Form::text('time', null, ['class' => 'form-control timepicker ','placeholder' => 'Ingresa Hora','required' => 'required']) !!}
                </div>
                <div class="form-group" >
                {!! Form::label('address', 'Dirección') !!}
			        {!! Form::text('address', null, ['class' => 'form-control','placeholder' => 'Ingresa dirección','required' => 'required']) !!}
                </div>
                

            <br>
            <br>
            <div style="width: 450px; margin: 0 auto;">
            <button id= btnagregar type="submit" class="btn btn-primary">Guardar</button>
            <br>
            <br>
            </div>

		</div>

        <style type="text/css">
        .dropdown{
    
   
        }
        </style>
        <style type="text/css">
        .input-group-addon{
    
        /*display:none;*/
         visibility:hidden;   
        }
        </style>
    </form>

    @section('js')
    
    
        <script>
           $('.datepicker').datepicker();
           $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30,
            minTime: '6',
            maxTime: '22:00pm',
            defaultTime: '7',
            startTime: '10:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
            });
        </script>
    
    @endsection
 
   