@extends('adminlte::layouts.app')
@section('contentheader_title')
 Modelos de Veículos
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('vehicleModels.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Novo Modelo
 		</button>
 		</a><br><br>
 	</div>
 	 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="vehicleModels-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Nome</th>
								<th>Fabricante</th>
					 		</tr>
					 	</thead>
					 	@foreach($vehicleModels as $vehicleModel)
					 	<tbody>
					 		<tr>
					 			<th>{{ $vehicleModel->id }}</th>
					 			<th>{{ $vehicleModel->name }}</th>
								<th>{{ $vehicleModel->make_id }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('vehicleModels.destroy', $vehicleModel->id)}}" class="btn btn-danger">
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
 
 @endsection