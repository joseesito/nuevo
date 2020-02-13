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

          @if(Session::has('Mensaje'))

          <div class="alert alert-success" role="alert">

          <strong font size=7 >Aviso: </strong> {{session('flash')}}
          <button type="button" class="close" data-dismiss="alert alert-label">
           <span aria-hidden="true">&times;</span>
          </button>


          {{ Session::get('Mensaje')}}
          </div>

        @endif

        @if(Session::has('Mensaje2'))

            <div class="alert alert-danger" role="alert">

            <strong font size=7 >Aviso: </strong> {{session('flash')}}
            <button type="button" class="close" data-dismiss="alert alert-label" >
            <span aria-hidden="true">&times;</span>
            </button>


            {{ Session::get('Mensaje2')}}
          </div>
          @endif



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
            <th>estado</th>

            <th width="280px">Acciones</th>
        </tr>
	    @foreach ($courses as $course)
	    <tr>
	        <td>{{ $course->name }}</td>
	        <td>{{ $course->name_type_course }}</td>
            <td>{{ $course->hours }}</td>
            <td>{{ $course->grade_min}}</td>
            @if($course->type_validity==1)
                @if($course->validity==1)
                <td>{{$course->validity.' Dia'}}</td>
                @else
                <td>{{$course->validity.' Dias'}}</td>
                @endif
            @endif
            @if($course->type_validity==2)
                @if($course->validity==1)
                <td>{{$course->validity.' Mes'}}</td>
                @else
                <td>{{$course->validity.' Meses'}}</td>
                @endif
            @endif
            @if($course->type_validity==3)
                @if($course->validity==1)
                <td>{{$course->validity.' Año'}}</td>
                @else
                <td>{{$course->validity.' Años'}}</td>
                @endif
            @endif
            <td>
                @if($course->state = 1)
                    <span class="label bg-green">Activo</span>
                @else
                    <span class="label bg-green">Desactivado</span>
                @endif
            </td>
	        <td>
                <form action="{{ route('courses.destroy',$course->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('courses.show',$course->id) }}">Mostrar</a>
                    @can('course-edit')
                    <a class="btn btn-primary" href="{{ route('courses.edit',$course->id) }}">Editar</a>
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
