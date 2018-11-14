@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Funcionários
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('employees.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Funcionario
 		</button>
 		</a><br><br>
 	</div>
 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="users-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Matrícula</th>
					 			<th>Nome</th>
								<th>Cargo</th>
					 			<th>Status</th>
					 			<th>Opções</th>

					 		</tr>
					 	</thead>
					 	@foreach($employees as $employee)
					 	<tbody>
					 		<tr>
					 			<th>{{ $employee->id }}</th>
					 			<th>{{ $employee->registration }}</th>
					 			<th>{{ $employee->name }}</th>
					 			<th>{{ $employee->occupation->name }}</th>
					 			<th>{{ $employee->formatedstatus }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('employees.destroy', $employee->id)}}" class="btn btn-danger">
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