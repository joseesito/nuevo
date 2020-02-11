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


    <form action="{{ route('inscription.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nombre:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name"value={{ isset($inscription->name)?$inscription->name:''  }}>
		        </div>
                <div class="form-group">
		            <strong>Ubicacion:</strong>
		            <input type="text" name="hours" class="form-control" placeholder="Name"value={{ isset($inscription->location_id)?$inscription->location_id:""}}>
		        </div>
                <div class="form-group">
		            <strong>Unity_id:</strong>
		            <input type="text" name="grade_min" class="form-control" placeholder="Name" value={{ isset($inscription->unity_id)?$inscription->unity_id:""}}>
		        </div>
                <div class="form-group" >
                    <strong>user_id</strong>
                    <input type="text" class="form-control" name="certificate" placeholder="Name"value={{ isset($inscription->user_id)?$inscription->user_id:""}}>
                </div>
                <div class="form-group" >
                    <strong>Direccion</strong>
                    <input type="text" class="form-control" name="certificate" placeholder="Name"value={{ isset($inscription->address)?$inscription->address:""}}>
                </div>
                <div class="form-group" >
                    <strong>Fecha_Inicio</strong>
                    <input type="text" class="form-control" name="certificate" placeholder="Name"value={{ isset($inscription->start_date)?$inscription->start_date:""}}>
                </div>
                <div class="form-group" >
                    <strong>Fecha_Fin</strong>
                    <input type="text" class="form-control" name="certificate" placeholder="Name"value={{ isset($inscription->end_date)?$inscription->end_date:""}}>
                </div>
                <div class="form-group" >
                    <strong>Hora</strong>
                    <input type="text" class="form-control" name="certificate" placeholder="Name"value={{ isset($inscription->hours)?$inscription->hours:""}}>
                </div>

                <div class="input-group">
                    <strong>Vigencia</strong>
                    <input type="number" id="txtname" name="validity" class="form-control" placeholder="Name" value={{ isset($inscription->validity)?$inscription->validity:""}}>
                
                
                
                <!--separador -->
                <span class="input-group-addon" ></span>
                &nbsp;
                <div class="dropdown">

                <select class="btn btn-primary dropdown-toggle"  name="type_validity" type="text" id="tipo_validaty">
    
                @if(isset($inscription) && $inscription->type_validity==1)
                <option value="1">Dia</option>
                <option value="2">Mes</option>
                <option value="3">Año</option>
                 @elseif(isset($inscription) && $inscription->type_validity==2)
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
            <button id= btnagregar type="submit" class="btn btn-primary">Guardar</button>
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