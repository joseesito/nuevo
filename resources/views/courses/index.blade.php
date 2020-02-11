@extends('adminlte::page')

@section('title', 'Souther')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Cursos</h2>
            </div>
            <div class="pull-right">
                @can('course-create')
                <a class="btn btn-success" href="{{ route('courses.create') }}"> Crear nuevo Curso</a>
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
            <th>Curso</th>
            <th>Tipo Curso</th>
            <th>Horas</th>
            <th>Nota minima</th>
            <th>Vigencia</th>
            
            <th width="280px">Action</th>
        </tr>
	    @foreach ($course as $cours)
	    <tr>
	        <td>{{ $cours->name }}</td>
	        <td>{{ $cours->nametype_course }}</td>
            <td>{{ $cours->hours }}</td>   
            <td>{{ $cours->grade_min}}</td>
            @if($cours->type_validity==1)
                @if($cours->validity==1)
                <td>{{$cours->validity.' Dia'}}</td>
                @else
                <td>{{$cours->validity.' Dias'}}</td>
                @endif
            @endif
            @if($cours->type_validity==2)
                @if($cours->validity==1)
                <td>{{$cours->validity.' Mes'}}</td>
                @else
                <td>{{$cours->validity.' Meses'}}</td>
                @endif
            @endif
            @if($cours->type_validity==3)
                @if($cours->validity==1)
                <td>{{$cours->validity.' Año'}}</td>
                @else
                <td>{{$cours->validity.' Años'}}</td>
                @endif
            @endif
            
	        <td>
                <form action="{{ route('courses.destroy',$cours->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('courses.show',$cours->id) }}">Mostrar</a>
                    @can('course-edit')
                    <a class="btn btn-primary" href="{{ route('courses.edit',$cours->id) }}">Editar</a>
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