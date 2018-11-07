@extends('adminlte::layouts.app')
@section('contentheader_title')
 Fornecedores
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('providers.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Fornecedor
 		</button>
 		</a><br><br>
 	</div>
 	 <br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="providers-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Nome</th>
					 			<th>Endereço</th>
					 			<th>Cidade</th>
					 			<th>Estado</th>
					 			<th>Telefone</th>
					 			<th>E-mail</th>
					 		</tr>
					 	</thead>
					 	@foreach($providers as $provider)
					 	<tbody>
					 		<tr>
					 			<th>{{ $provider->id }}</th>
					 			<th>{{ $provider->name }}</th>
					 			<th>{{ $provider->address }}</th>
					 			<th>{{ $provider->city->name }}</th>
					 			<th>{{ $provider->city->state->name }}</th>
					 			<th>{{ $provider->phone }}</th>
					 			<th>{{ $provider->email }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 				<a href="{{ route('providers.destroy', $provider->id)}}" class="btn btn-danger">
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