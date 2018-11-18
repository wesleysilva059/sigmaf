<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Relatorio de Manutenção por Veículo</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<head>
		<img src="img/logo.jpg"style="
                width: 250px;
                align-content: center;">
		<h1>Relatório de Manutenção do Veículo </h1>
		<h3>Placa {{$maintenance->vehicle->vehiclePlate}} - {{$maintenance->vehicle->vehicleModel->name}}</h3>
	</head>
	<hr>	      
	<div class="container">
  		<div class="row">
	  		<div class="col-xs-4 col-md-4">
	  			<b>Codigo</b><br>    
					{{$maintenance->cod}}<br>
	  		</div>
	  		<div class="col-xs-4 col-md-4">
	  			<b>Placa do Veículo</b><br>
					{{$maintenance->vehicle->vehiclePlate}}<br>
			</div>
			<div class="col-xs-4 col-md-4">
	  			<b>Data Inicial do Chamado</b><br>
					{{$maintenance->formatedinitDateMaintenance}}<br>
			</div>
		</div>
		<br><br>
		<div class="row">
	  		<div class="col-xs-4 col-md-4">
	  			<b>Aquisição de Itens?</b><br>
				@if($maintenance->purchaseItem == 0)
					Sim
				@else
					Não
				@endif
				<br>
			</div>
			<div class="col-xs-4 col-md-4">
	  			<b>Prestação de Serviço</b><br>
				@if($maintenance->localService == 0)
					Oficina Terceirizada
				@else
					Oficina Própria
				@endif
				<br>
			</div>
		</div>
		<br><br>
		<div class="row">
	  		<div class="col-xs-4 col-md-4">
	  			<b>Prioridade</b><br>   
				@if($maintenance->priority == 0)
					Baixa
				@elseif($maintenance->priority == 1)
					Média
				@elseif($maintenance->priority == 2)
					Alta
				@elseif($maintenance->priority == 3)
					Urgente	
				@endif
				<br>
	  		</div>
	  		<div class="col-xs-4 col-md-4">
	  			<b>Categoria de manutenção</b><br>
				{{$maintenance->maintenanceCategory->name}}<br>
			</div>
			<div class="col-xs-4 col-md-4">
	  			<b>Status da Manutenção</b><br>
				{{$maintenance->maintenanceStatus->name}}<br>
			</div>
		</div>
		<br><br>
		<div class="row">
	  		<div class="col-xs-4 col-md-4">
	  			<b>Secretaria / Orgão</b><br>   
				{{$maintenance->costCenter->department->name}}<br>
	  		</div>
	  		<div class="col-xs-4 col-md-4">
	  			<b>Centro de Custo</b><br> 
				{{$maintenance->costCenter->name}}<br>
			</div>
			<div class="col-xs-4 col-md-4">
	  			<b>Km / Hr Atual</b><br>
				{{$maintenance->currentKmHr}}<br>
			</div>
		</div>
		<br><br>
		<div class="row">
	  		<div class="col-xs-10 col-md-4">
	  			<b>Relato Inicial</b><br> 
				{{$maintenance->story}}<br>
	  		</div>
	  	</div>
		<br><br>
	  	<div class="row">
	  		<div class="col-xs-10 col-md-4">
	  			<b>Manutenção Prevista</b><br>	      
				{{$maintenance->plannedMaintenance}}<br>
	  		</div>
	  	</div>
		<br><br>
	  	<div class="row">
	  		<div class="col-xs-4 col-md-4">
	  			<b>Fornecedor Peças</b><br>     
				{{$maintenance->provider->name}}<br>
			</div>
	  		<div class="col-xs-4 col-md-4">
	  			<b>Oficina</b><br>    
				{{$maintenance->machineShop->name}}<br>
			</div>
			<div class="col-xs-4 col-md-4">
	  			<b>Data de Previsão(Término)</b><br>
				{{$maintenance->formatedexpectedDateEnd}}<br>
			</div>
		</div>
		<br><br>

	<footer>
		<div class="row">
			Relatório emitido em {{$today}} 
		</div>
	</footer>

	</div>
</div>		
</body>
</html>