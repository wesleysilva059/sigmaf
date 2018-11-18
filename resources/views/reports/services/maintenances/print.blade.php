<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Relatorio de Manutenção Por Período</title>
	<link rel="stylesheet" href="">
	<link href="css/all.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<head>
		<img src="img/logo.jpg"style="
                width: 250px;
                align-content: center;">
		<h1>Relatório de Manutenção Por Período</h1>
		@if(isset($date_init) && isset($date_end))
			<h3>{{$date_init}} a {{$date_end}}</h3>
		@endif
	</head>
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<div class="box-body">
				<table class="table table-hover table-condensed" style="width: 100%" id="printManut">
					<thead>
						<tr>
							<th width="10%">Placa</th>
				 			<th width="15%">Secretaria</th>
				 			<th width="15%">Data de Registro</th>
				 			<th width="25%">Status</th>
				 			<th width="15%">Tipo</th>
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