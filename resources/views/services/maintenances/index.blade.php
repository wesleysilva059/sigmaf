@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Manutenções
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('maintenances.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Manutenção
 		</button>
 		</a><br><br>
 	</div>
 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="vehicles-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Data de Início</th>
					 			<th>Placa</th>
					 			<th>Marca/Modelo</th>
					 			<th>Secretaria / Orgão</th>
					 			<th>Status</th>
					 			<th>Opções</th>
					 		</tr>
					 	</thead>
					 	@foreach($maintenances as $maintenance)
					 	<tbody>
					 		<tr>
					 			<th>{{ $maintenance->cod }}</th>
					 			<th>{{ $maintenance->formatedinitDateMaintenance}}</th>
					 			<th>{{ $maintenance->vehicle->vehiclePlate }}</th>
					 			<th>{{ $maintenance->vehicle->vehicleModel->make->name. ' / '. $maintenance->vehicle->vehicleModel->name}}</th>
					 			<th>{{ $maintenance->department->name }}</th>
					 			<th>{{ $maintenance->maintenanceStatus->name }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('maintenances.destroy', $maintenance->id)}}" class="btn btn-danger">
					 					<i class="fa fa-trash"></i>
					 				</a>
					 			</td>
					 		</tr>
					 	</tbody>
					 	@endforeach
					 </table>
 				</div>
 			</div>
 		</div>
 	</div>
@stop