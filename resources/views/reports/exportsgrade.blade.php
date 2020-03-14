@extends('adminlte::page')

@section('title', 'Southern')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
               
            </div>
            <div class="pull-right">
                @can('participant-create')
                <div clas="form-group text-center">
                    <a class="btn btn-default" style="position:absolute;top:20px;left:1200px" href="{{ route('exports.grade', $inscription->id) }}"> Exportar</a>
                </div>   
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
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('Mensaje2')}}
            </div>
          @endif

          <div id="modalParticipants" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection