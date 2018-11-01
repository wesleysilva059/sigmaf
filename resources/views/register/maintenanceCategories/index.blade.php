@extends('adminlte::layouts.app')
@section('contentheader_title')
 Categorias de Manutenção
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('maintenanceCategories.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Categoria
 		</button>
 		</a><br><br>
 	</div>
 	 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="maintenanceCategories-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Nome</th>
					 		</tr>
					 	</thead>
					 	@foreach($maintenanceCategories as $maintenanceCategory)
					 	<tbody>
					 		<tr>
					 			<th>{{ $maintenanceCategory->id }}</th>
					 			<th>{{ $maintenanceCategory->name }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('maintenanceCategories.destroy', $maintenanceCategory->id)}}" class="btn btn-danger">
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