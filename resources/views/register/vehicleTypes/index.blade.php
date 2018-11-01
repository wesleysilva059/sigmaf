@extends('adminlte::layouts.app')
@section('contentheader_title')
 Tipos de Veículos
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('vehicleTypes.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Novo Tipo
 		</button>
 		</a><br><br>
 	</div>
 	 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="vehicleTypes-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Nome</th>
								<th>Porte</th>
					 		</tr>
					 	</thead>
					 	@foreach($vehicleTypes as $vehicleType)
					 	<tbody>
					 		<tr>
					 			<th>{{ $vehicleType->id }}</th>
					 			<th>{{ $vehicleType->name }}</th>
								<th>{{ $vehicleType->vehicleSize }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('vehicleTypes.destroy', $vehicleType->id)}}" class="btn btn-danger">
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