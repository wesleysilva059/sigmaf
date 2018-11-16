<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Relatorio de Manutenção Por Período</title>
	<link rel="stylesheet" href="">
	<link href="{{ mix('/css/all.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
	<head>
		<img src="{{URL::asset('/img/logo.jpg')}}">
		<h1>Relatório de Manutenção Por Período</h1>
		<h2></h2>
	</head>
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<div class="box-body">
				<table class="table table-hover table-condensed" style="width: 100%" id="printManut">
					<thead>
						<tr>
							<th>Placa</th>
				 			<th>Secretaria</th>
				 			<th>Data de Registro</th>
				 			<th>Status</th>
				 			<th>Tipo</th>
			 			</tr>
					</thead>
					@foreach($historics as $historic)
					 	<tbody>
					 		<tr>
					 			<td>{{ $historic->vehicle->vehiclePlate }}</td>
					 			<td>{{ $historic->department->name }}</td>
					 			<td>{{ $historic->formatedinitDateMaintenance}}</td>
					 			<td>{{ $historic->maintenanceStatus->name}}</td>
					 			<td>{{ $historic->maintenanceCategory->name}}</td>
					 		</tr>
					 	</tbody>
					 @endforeach
				</table>
			</div>
		</div>
	</div>
	<hr>
	<footer>
		<div>
			Relatório emitido em {{$today}} 
		</div>
	</footer>
</body>
</html>