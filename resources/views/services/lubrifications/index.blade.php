@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Lubrificação
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('lubrifications.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Lubrificação
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
					 			<th>KM / Hr</th>
					 			<th>Resp. Serviço</th>
					 			<th>Prox. Troca</th>
					 			<th>Opções</th>
					 		</tr>
					 	</thead>
					 	@foreach($lubrifications as $lubrification)
					 	<?php $total = $lubrification->currentKmHr+$lubrification->periodlubrification ?>
					 	<tbody>
					 		<tr>
					 			<th>{{ $lubrification->id }}</th>
					 			<th>{{ $lubrification->vehicle->vehiclePlate }}</th>
					 			<th>{{ $lubrification->formatedinitDate}}</th>
					 			<th>{{ $lubrification->currentKmHr }}</th>
					 			<th>{{ $lubrification->employee->name }}</th>
					 			<th>{{ $lubrification->formatednextDatelubrification . ' / '. $total }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('lubrifications.destroy', $lubrification->id)}}" class="btn btn-danger">
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