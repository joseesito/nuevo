@extends('adminlte::page')

@section('title', 'Souther')

@section('content_header')
@stop

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Inscription Curso</h2>
            </div>
            <div class="pull-right">
                @can('inscription-create')
                <a class="btn btn-success" href="{{ route('inscriptions.create') }}"> Crear nueva Programación</a>
                @endcan
            </div>
        </div>
    </div>
    <body>
          @if(Session::has('Mensaje'))

          <div class="alert alert-success" role="alert">

          <strong font size=7 >Aviso: </strong> {{session('flash')}}
          <button type="button" class="close" data-dismiss="alert" alert-label
           <span aria-hidden="true">&times;</span>
          </button>
       
       
          {{ Session::get('Mensaje')}}
          </div>

        @endif

        @if(Session::has('Mensaje2'))

            <div class="alert alert-danger" role="alert">

            <strong font size=7 >Aviso: </strong> {{session('flash')}}
            <button type="button" class="close" data-dismiss="alert" alert-label
            <span aria-hidden="true">&times;</span>
            </button>


            {{ Session::get('Mensaje2')}}
          </div>
          @endif

          </body>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>lugar</th>
            <th>Curso</th>
            <th>Fecha Inicio</th>
            <th>Hora</th>
            <th>Vacantes</th>
            
            <th width="280px">Action</th>
        </tr>
	    @foreach ($inscription as $inscriptio)
	    <tr>
        <td>{{ $inscriptio->nameLocation }}</td>
	        <td>{{ $inscriptio->namecurso }}</td>
            <td>{{ $inscriptio->start_date}}</td>
            <td>{{ $inscriptio->hours }}</td>  
            <td>{{ $inscriptio->slot}}</td>
            @if($inscriptio->type_validity==1)
                @if($inscriptio->validity==1)
                <td>{{$inscriptio->validity.' Dia'}}</td>
                @else
                <td>{{$inscriptio->validity.' Dias'}}</td>
                @endif
            @endif
            @if($inscriptio->type_validity==2)
                @if($inscriptio->validity==1)
                <td>{{$inscriptio->validity.' Mes'}}</td>
                @else
                <td>{{$inscriptio->validity.' Meses'}}</td>
                @endif
            @endif
            @if($inscriptio->type_validity==3)
                @if($inscriptio->validity==1)
                <td>{{$inscriptio->validity.' Año'}}</td>
                @else
                <td>{{$inscriptio->validity.' Años'}}</td>
                @endif
            @endif
            
	        <td>
                <form action="{{ route('inscriptions.destroy',$inscriptio->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('inscriptions.show',$inscriptio->id) }}">Mostrar</a>
                    @can('course-edit')
                    <a class="btn btn-primary" href="{{ route('inscriptions.edit',$inscriptio->id) }}">Editar</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('course-delete')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


@stop