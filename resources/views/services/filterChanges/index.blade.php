@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Troca de Filtro
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('filterChanges.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Troca de Filtro
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
								<th>Tipo</th>
					 			<th>KM / Hr</th>
					 			<th>Resp. Serviço</th>
					 			<th>Prox. Troca</th>
					 			<th>Opções</th>
					 		</tr>
					 	</thead>
					 	@foreach($filterChanges as $filterChange)
					 	<?php $total = $filterChange->currentKmHr+$filterChange->periodFilterChange ?>
					 	<tbody>
					 		<tr>
					 			<th>{{ $filterChange->id }}</th>
					 			<th>{{ $filterChange->vehicle->vehiclePlate }}</th>
					 			<th>{{ $filterChange->formatedinitDate}}</th>
					 			<th>{{ $filterChange->filterChangeType->name}}</th>
					 			<th>{{ $filterChange->currentKmHr }}</th>
					 			<th>{{ $filterChange->employee->name }}</th>
					 			<th>{{ $filterChange->formatednextDateFilterChange . ' / '. $total }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('filterChanges.destroy', $filterChange->id)}}" class="btn btn-danger">
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