@extends('adminlte::layouts.app')
@section('contentheader_title')
 Tipos de Troca de Filtro
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('filterChangeTypes.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Tipo de Troca de Filtro
 		</button>
 		</a><br><br>
 	</div>
 	 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="filterChangeTypes-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Nome</th>
					 		</tr>
					 	</thead>
					 	@foreach($filterChangeTypes as $filterChangeType)
					 	<tbody>
					 		<tr>
					 			<th>{{ $filterChangeType->id }}</th>
					 			<th>{{ $filterChangeType->name }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('filterChangeTypes.destroy', $filterChangeType->id)}}" class="btn btn-danger">
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