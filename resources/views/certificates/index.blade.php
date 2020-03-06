<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de isncripciones Southern</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        html {
            color: #FFF;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #A62A43;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        body {
            background: url('img/banner/banner1.png') no-repeat center center scroll;
            height: 100vh;
            min-height: 350px;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            margin: 0;
        }

    </style>
</head>
<body>
<div class="full-height">

    <div class="container">

        <div class="row">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesión</a>
                    @endauth
                    <a href="{{ url('/certificado') }}">Certificado</a>
                </div>
            @endif

        </div>

        <div class="row" style="margin-top: 100px">
            <div class="col">
                <div class="card" style="opacity: .95">
                    <div class="card-header">
                        Buscar Certificado
                    </div>
                    <div class="card-body">
                        <form action="{{ route('certificate.list') }}" method="post" class="form-inline">
                            {{ csrf_field() }}
                            <input name="doc" class="form-control mr-sm-3" type="search" placeholder="Ingrese su Documento" aria-label="Search" value="{{ old('doc', $doc) }}">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                        <h5 class="card-title mt-3">Lista de certificados</h5>

                        <table class="table table-sm table-bordered" id="datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Dni/Documento</th>
                                <th>Partcipante</th>
                                <th>Curso</th>
                                <th>Nota</th>
                                <th>Fecha</th>
                                <th>Certificado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($query as $certificate)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <th>{{ $certificate->document }}</th>
                                    <th>{{ $certificate->last_name }} {{ $certificate->name }}</th>
                                    <th>{{ $certificate->course }}</th>
                                    <th>{{ $certificate->grade }}</th>
                                    <td>{{ $certificate->start_date }}</td>
                                    @if($certificate->approved == 1)
                                        <td><a href="{{ route('certificate.export', $certificate->id) }}" class="btn btn-sm btn-outline-success">certificado</a></td>
                                    @else
                                        <td class="text-danger">Desaprobado</td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No tiene ningun certificado.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
