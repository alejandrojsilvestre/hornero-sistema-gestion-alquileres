@php($sucursal=Auth::user()->sucursal)
<html>
    <head>
        <style>
            body{padding:0px;margin:0px}
            .pull-left{float:left;}
            .pull-right{float:right;}
            .md6{width:49%;}
            .taright{text-align:right;}
            header,section{padding:10px}
            .logo{height:150px}
            .clear{clear:both} 
            h2{margin:0px}
            h1{text-align:center}

            table{width:100%;text-align:left;}
            table thead tr th,table thead tr td{text-align:left;}

            table,
            th,
            td {
                padding: 10px;
                border: 5px solid #eee;
                border-collapse: collapse;
            }

            thead{background:#eee;}
        </style>
    </head>
    <body>
        <!-- <header>
            <div class="md6 pull-left">
                <h2>{{ $sucursal->razon_social }}</h2>
                @if($sucursal->logo)
                    <img src="{{$sucursal->logo('base64')}}" class="logo" />
                @else
                    <img src="{{public_path('images/logo_demo.png')}}" class="logo" />
                @endif
            </div>
            <div class="md6 pull-right taright">
                {{$sucursal->direccion}}, {{$sucursal->localidad}}, {{$sucursal->provincia}}<br />
                {{$sucursal->telefono}}<br />
                {{$sucursal->email}}<br /><br />

                Fecha: {{date('d/m/Y')}}<br />
                Hora: {{date('H:i:s')}}
            </div>
            <div class="clear"></div>
        </header> -->

        <section>
            <h1>@yield('title','Reporte')</h1>
            
            <div class="content">
                @yield('content')
            </div>
        <section>

        <footer>
        </footer>
    </body>
</html>