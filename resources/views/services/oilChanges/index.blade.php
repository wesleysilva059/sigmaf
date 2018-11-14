@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Troca de Óleo
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('oilChanges.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Troca de óleo
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
					 	@foreach($oilChanges as $oilChange)
					 	<?php $total = $oilChange->currentKmHr+$oilChange->periodOilChange ?>
					 	<tbody>
					 		<tr>
					 			<th>{{ $oilChange->id }}</th>
					 			<th>{{ $oilChange->vehicle->vehiclePlate }}</th>
					 			<th>{{ $oilChange->formatedinitDate}}</th>
					 			<th>{{ $oilChange->oilChangeType->name}}</th>
					 			<th>{{ $oilChange->currentKmHr }}</th>
					 			<th>{{ $oilChange->employee->name }}</th>
					 			<th>{{ $oilChange->formatednextDateOilChange . ' / '. $total }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('oilChanges.destroy', $oilChange->id)}}" class="btn btn-danger">
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