@extends('adminlte::layouts.app')
@section('contentheader_title')
	Centros de Custo
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('costCenter.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Centro de Custo
 		</button>
 		</a><br><br>
 	</div>
 	 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="departments-table">
					 	<thead>
					 		<tr>
					 			<th>ID</th>
					 			<th>Nome</th>
					 			<th>Secretaria / Orgão </th>
					 		</tr>
					 	</thead>
					 	@foreach($costCenters as $costCenter)
					 	<tbody>
					 		<tr>
					 			<th>{{ $costCenter->id }}</th>
					 			<th>{{ $costCenter->name }}</th>
					 			<th>{{ $costCenter->department->name }}</th>
					 		<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('costCenters.destroy', $costCenter->id)}}" class="btn btn-danger">
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