@extends('adminlte::layouts.app')
@section('contentheader_title')
 Oficinas
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('machineShops.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Oficina
 		</button>
 		</a><br><br>
 	</div>
 	 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="machineShops-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Nome</th>
					 			<th>Endereço</th>
					 			<th>Telefone</th>
					 		</tr>
					 	</thead>
					 	@foreach($machineShops as $machineShop)
					 	<tbody>
					 		<tr>
					 			<th>{{ $machineShop->id }}</th>
					 			<th>{{ $machineShop->name }}</th>
					 			<th>{{ $machineShop->address }}</th>
					 			<th>{{ $machineShop->phone }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('machineShops.destroy', $machineShop->id)}}" class="btn btn-danger">
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