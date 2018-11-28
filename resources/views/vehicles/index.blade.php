@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Veículos
@endsection
@section('main-content')
	@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
 	<div style="float:right;">
 		<a href="{{ route('vehicle.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Veículo
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
					 			<th width="5%">#</th>
					 			<th width="10%">Placa</th>
					 			<th width="25%">Marca/Modelo</th>
					 			<th width="10%">Tipo</th>
					 			<th width="25%">Secretaria / Orgão</th>
					 			<th width="10%">Status</th>
					 			<th width="20%">Opções</th>
					 		</tr>
					 	</thead>
					 	@foreach($vehicles as $vehicle)
					 	<tbody>
					 		<tr>
					 			<th>{{ $vehicle->id }}</th>
					 			<th>{{ $vehicle->vehiclePlate }}</th>
					 			<th>{{ $vehicle->vehicleModel->make->name. ' / '. $vehicle->vehicleModel->name}}</th>
					 			<th>{{ $vehicle->vehicleType->name }}</th>
					 			<th>{{ $vehicle->costCenter->department->name }}</th>
					 			<th>{{ $vehicle->formatedstatus }}</th>
					 			<td>
					 				<a href="{{route('vehicles.edit', $vehicle->id)}}" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<form action="{{ route('vehicles.destroy', $vehicle->id)}}" method="post">
                  					@csrf
                  					@method('DELETE')
                  						<button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                					</form>
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