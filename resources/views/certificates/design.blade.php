<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Certificado Perurail</title>

    <style>

        html {
            margin: 0;
            padding: 0;
        }

        body {
            padding: 0;
            margin: 0;
            font-family: sans-serif;
        }
        div.papa {
            position: relative;
            /*left: 0; top: -265px; right: 0; bottom: 0;*/
            height: 97%;
            text-align: center;
            z-index: -500;
        }

        div.codigo {
            position: absolute;
            top: 50px;
            left: 90%;
            color: rgba(252, 243, 249, 0.81);
        }

        div.nombre{
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 11%;
            right: 0;
            height: auto;
            width: 84%;
            color:#373435;
            top: 225px;
            font-size: 47px;
            font-weight: 700;
        }

        div.dni{
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 24%;
            right: 0;
            height: auto;
            width: 70%;
            color: #373435;
            top: 308px;
            font-size: 36px;
            font-weight: 600;
        }

        div.curso{
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            top: 430px;
            left: 5%;
            right: 0;
            height: auto;
            width: 90%;
            font-weight: bold;
            font-size: 45px;
            color: rgb(135, 33, 46);
            /*text-transform: uppercase;*/
        }

        div.curso-xl {
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            top: 525px;
            left: 5%;
            right: 0;
            height: auto;
            width: 90%;
            font-weight: bold;
            font-size: 37px;
            color: rgb(135, 33, 46);
        }

        div.fecha {
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            top: 560px;
            left: 10%;
            right: 0;
            height: auto;
            width: 80%;
            color: rgb(146, 150, 148);
            font-size: 22px;
            font-weight: 400;
        }

        .horas {
            position: absolute;
            top: 547px;
            left: 10%;
            width: 80%;
            color: #363435;
            font-size: 16px;
        }


        div.detalle {
            position: absolute;
            top: 355px;
            left: 8%;
            width: 84%;
            font-weight: bold;
            color: rgb(0,72,145);
        }

        .container {
            width: 100%;
            display: flex;
            height: 100%;
            font-size: 25px;
            text-transform: uppercase;
            text-align: justify;

        }

        .container-xl {
            width: 100%;
            display: flex;
            height: 100%;
            font-size: 22px;
            text-transform: uppercase;
            text-align: justify;
            border: 2px solid blue;


        }

        .item-1 {
            width: 15%;
            color: #353334;
        }

        .item-2 {
            margin-left: 15%;
            width: 85%;
            color: rgb(0,72,145);
        }

        .page-break { page-break-after: always; }

    </style>

</head>
<body>

{{-- for para uno o mas certificados --}}
    <div style="position: absolute; left: 0; top: -265px; right: 0; bottom: 0px; text-align: center;z-index: -1000;">
        <img src="https://www.ighgroup.com/southern/img/certificate/certificado.png" style="width: 100%; margin-top: 25%;">
    </div>
    <div class="papa">
        <div class="codigo">SO-{{ str_pad($inscriptionUser->id, 8, "0", STR_PAD_LEFT) }}</div>
        <div class="nombre">{{ $inscriptionUser->user->last_name }} {{ $inscriptionUser->user->name }}</div>
        <div class="dni">{{ $inscriptionUser->user->document }}</div>
        @if(true)
            <div class="curso">{{ $inscriptionUser->inscription->name }}</div>
        @else
            <div class="curso-xl">{{ $inscriptionUser->inscription->name }}</div>
        @endif
        <div class="fecha">Con una duración de
            {{ str_pad($inscriptionUser->inscription->hours, 2, "0", STR_PAD_LEFT) }} horas lectivas.
            El día: {{ $date }}</div>
    </div>

{{-- Fin for --}}
</body>
</html>
