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


    <form action="{{ route('courses.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nombre:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name"value={{ isset($course->name)?$course->name:''  }}>
		        </div>
                <div class="form-group">
		            <strong>tipo de curso:</strong>
                    {!! Form::select('type_course_id', $type, null, ['class' => 'form-control']) !!}
		            
		        </div>
                <div class="form-group">
		            <strong>Horas:</strong>
		            <input type="number" name="hours" class="form-control" placeholder="Name"value={{ isset($course->hours)?$course->hours:""}}>
		        </div>
                <div class="form-group">
		            <strong>Nota minima:</strong>
		            <input type="number" name="grade_min" class="form-control" placeholder="Name" value={{ isset($course->grade_min)?$course->grade_min:""}}>
		        </div>
                <div class="form-group" >
                    <strong>Certificate</strong>
                    <input type="text" class="form-control" name="certificate" placeholder="Name"value={{ isset($course->certificate)?$course->certificate:""}}>
                </div>
                <div class="input-group">
                    <strong>Vigencia</strong>
                    <input type="number" id="txtname" name="validity" class="form-control" placeholder="Name" value={{ isset($course->validity)?$course->validity:""}}>
                
                
                
                <!--separador -->
                <span class="input-group-addon" ></span>
                &nbsp;
                <div class="dropdown">

                <select class="btn btn-primary dropdown-toggle"  name="type_validity" type="text" id="tipo_validaty">
    
                @if(isset($course) && $course->type_validity==1)
                <option value="1">Dia</option>
                <option value="2">Mes</option>
                <option value="3">Año</option>
                 @elseif(isset($course) && $course->type_validity==2)
                <option value="2">Mes</option>
                <option value="1">Dia</option>
                <option value="3">Año</option>
                @else 
                <option value="3">Año</option>
                <option value="2">Mes</option>
                <option value="1">Dia</option>
                @endif
                </select>

                </div>
       
            <br>
            <br>
            <br>
            <div style="width: 450px; margin: 0 auto;">
            <button id= btnagregar type="submit" class="btn btn-primary btn_submit_register">Guardar</button>
            </div>

		</div>
        <style type="text/css">
        #txtname{
            right:12px;
        }
        
        </style>

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