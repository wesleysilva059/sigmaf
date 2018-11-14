@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Limpeza
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('cleanings.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Limpeza
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
					 			<th>Placa</th>					 			
					 			<th>Data de Início</th>
					 			<th>KM / Hr Atual</th>
					 			<th>Resp. Serviço</th>
					 			<th>Opções</th>
					 		</tr>
					 	</thead>
					 	@foreach($cleanings as $cleaning)
					 	<?php $total = $cleaning->currentKmHr+$cleaning->periodcleaning ?>
					 	<tbody>
					 		<tr>
					 			<th>{{ $cleaning->id }}</th>
					 			<th>{{ $cleaning->vehicle->vehiclePlate }}</th>
					 			<th>{{ $cleaning->formateddate}}</th>
					 			<th>{{ $cleaning->currentKmHr }}</th>
					 			<th>{{ $cleaning->employee->name }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('cleanings.destroy', $cleaning->id)}}" class="btn btn-danger">
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