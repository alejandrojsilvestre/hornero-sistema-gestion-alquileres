<html lang="es">
<head>	<style type="text/css">
	body{
		background-color:#FFFFFF;
		border: 1px solid;
	}
	#page1{
		width:165mm; /*210-40*/
		height:237.4mm; /*297.4-60*/
		background-color:white;
		padding:20mm 20mm 20mm 20mm;
		margin-left:auto;
		margin-right:auto;
		box-shadow: 0 0 50px #888888;
	}
	header{height:20%;border-bottom:1px solid #000000;}
	header>div{float:left}
	header div.left, header div.right{width:40%;}
	header div.center{width:20%;height:20%;border-left:1px solid #000000; border-right:1px solid #000000;}
	section{padding:3mm 3mm 5mm 5mm;}
	section, pre{margin:0px;}
	.bordeRecibo section{padding:20px;}
	footer{position:absolute; bottom:0;left:0;right:0;padding:3mm 3mm 5mm 5mm;} /*Para que el footer llegue hasta abajo*/
	img{margin-bottom:2px;height:85px;max-width:208;}
	.column{height: calc(100% - 8px);}
	.row{left:0;right:0;position:relative;}
	.text-center{text-align:center;}
	.text-left{text-align:left;}
	.text-right{text-align:right;}
	.negrita{font-weight:bold!important;}
	.preimpreso{color:#999999;text-transform:uppercase;}
	.h1{font-size:50px;}
	.h2{font-size:40px;}
	.h3{font-size:24px;}
	.container{margin:0 20px 0 20px;}
	.bordeRecibo{border:1px solid #000000;margin:0;padding:0;height:100%;position:relative;} /*Para que el footer llegue hasta abajo*/
	.pull-right{position:absolute;right:0;}

	#tipoComprobante{font-size:100px;}
	#leyendaTipoComprobante{font-size:20px;}
	#tipoComprobante, #lblComprobante{line-height:70%;}
	#lblNroCmp{line-height:200%;}
	#hr{width:30%;border-top:1px solid #000000;height:1px;position:absolute;right:20px;}
	#firma{padding-top:30mm;position:relative;}
	.importeEnPesos:before{content:'$';}
	</style>
</head>
<body>
	<header>
		<!-- Lado Izquierdo -->
		<div class="column left">
			<div class="container">
				<br/>
				<div class="row text-left">
					<img src="{{ $cobro->sucursal->logo() }}" alt="logo" width="400" height="600">
				</div>
				<div class="row text-left negrita h3">{{ $cobro->empresa->razon_social }}</div>
				<div class="row text-left h3">{{ $cobro->empresa->slogan }}</div>
				<div class="row text-left h3">{{ $cobro->sucursal->direccion }}</div>
				<div class="row text-left h3">{{ $cobro->sucursal->mail }}</div>
				<div class="row text-left h3">{{ $cobro->sucursal->telefono }}</div>
			</div>
		</div>
		<!-- Lado Central -->
		<div class="column center text-center"> 
			<br/><br/><br/>
			<span id="tipoComprobante">X</span> 
			<br>
			<span id="leyendaTipoComprobante" class="preimpreso">DOCUMENTO<br>NO VALIDO<br>COMO<br>FACTURA</span> 
		</div>
		<!-- Lado Derecho -->
		<div class="column right">
			<div class="container">
				<br/>
				<br/>
				<div id="lblComprobante" class="row text-center negrita h1">RECIBO</div>
				<br/>
				<br/>
				<!-- <div id="lblNroCmp" class="row text-center negrita h2"><span class="preimpreso">Nro</span> 0001 - 00000000</div>
				<div class="row text-center h3">ORIGINAL</div> -->
				<div class="row text-center h3">&nbsp;</div>
				<div class="row text-left h3">FECHA: <span class="pull-right">{{ ($pago->fecha) ? $pago->fecha : date('d-m-Y')  }}</span></div>
				<div class="row text-left h3">CUIT: <span class="pull-right">{{ $cobro->sucursal->nro_cui }}</span></div>
				<div class="row text-left h3">ING.BRUTOS: <span class="pull-right">{{ $cobro->sucursal->ingresos_brutos }}</span></div>
				<div class="row text-left h3">INICIO DE ACTIVIDADES: <span class="pull-right">{{ $cobro->sucursal->inicio_actividades }}</span></div>
			</div>
		</div>
		</div>
	</header>
	<section>Buenos Aires, {{ $pago->fecha }}
		<br>
		<br>
		<span class="preimpreso">Recibí de</span> {{ $cobro->empresa->razon_social }}
		<br>
		<span class="preimpreso">la cantidad de </span><span id="importeEnLetras">{{ $pago->monto_letras.' ('.$pago->monto.')' }}</span> 
	</section>
	<section id="sectionMedioPago">
		<span class="preimpreso">Mediante</span> 
		@if($pago->monto)
		<div class="row">
			<span>Efectivo</span>
			<span class="pull-right negrita importeEnPesos">{{ $pago->monto }}</span>
		</div>
		@endif
	</section>
	<section>
		<span class="preimpreso">En concepto de</span>
		<div class="row">
			<span>
				{{ ($cobro->is_deuda) ? 'Deuda de ' : '' }} Alquiler de {{ $cobro->contrato->inmueble->direccion }} -
			</span>
			<span class="negrita">
				Periodo: {{ $cobro->periodo }} 
			</span>
			<span name="a" class="pull-right negrita importeEnPesos">{{ $pago->monto }}</span>
		</div>
		@if($pago->honorarios>0)
		<div class="row">
			<span>Punitorios</span>
			<span class="pull-right negrita importeEnPesos">{{ $pago->monto }}</span>
		</div>
		@endif
		@if($cobro->punitorio>0 && !$cobro->contrato->punitorios_administracion)
		<div class="row">
			<span>Punitorios</span>
			<span class="pull-right negrita importeEnPesos">{{ $cobro->punitorio }}</span>
		</div>
		@endif
		@if($pago->total_gastos)
		<div class="row">
			<span>Gastos</span>
			<span class="pull-right negrita importeEnPesos">{{ $cobro->total_gastos }}</span>
		</div>
		@endif
	</section>
	<section>
		@if($pago->gastos_liquidados->count()>0)
		<span class="preimpreso">Detalle de gastos</span>
	      @foreach ($pago->gastos_liquidados as $gasto_liquidado)
	       	<div class="row">
				<span>{{ $gasto_liquidado->concepto->nombre }}</span>
				<span class="pull-right negrita importeEnPesos">{{ $gasto_liquidado->monto }}</span>
			</div>
	      @endforeach
	    @endisset
	</section>
	<section>
		@if($cobro->impuestos_entregados->count()>0)
		<span class="preimpreso">Comprobantes entregados</span>
	      @foreach ($cobro->impuestos_entregados as $impuesto_entregado)
	       	<div class="row">
				<span>{{ $impuesto_entregado->servicio->nombre }} ({{ $impuesto_entregado->monto }})</span>
			</div>
	      @endforeach
	    @endisset
	</section>
	<footer>
		<div class="row">
			<p class="pull-right">Total: <span name="a" class="negrita importeEnPesos">{{ $pago->monto }}</span></p>
			
		</div>
		<!-- <section id="firma">
			<p class="text-right">--------------------------------</p>
			<p class="text-right">{{ $pago->propietario->getFullName() }}</p>
		</section> -->
	</footer>
</body>
</html>