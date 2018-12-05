@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Usuários
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('users.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Usuário
 		</button>
 		</a><br><br>
 	</div>
 <br><br>
 	<div class="box box-primary">
 		@if(session()->get('success'))
    		<div class="alert alert-success">
      			{{ session()->get('success') }}  
    		</div><br />
  		@endif
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
					 			<th>Secretaria/Orgão</th>
					 			<th>Status</th>
					 			<th width="5%">Opções</th>

					 		</tr>
					 	</thead>
					 	@foreach($users as $user)
					 	<tbody>
					 		<tr>
					 			<th>{{ $user->id }}</th>
					 			<th>{{ $user->registration }}</th>
					 			<th>{{ $user->name }}</th>
					 			<th>{{ $user->occupation->name }}</th>
					 			<th>{{ $user->department->name }}</th>
					 			<th>{{ $user->formatedstatus }}</th>
					 			<td>
					 				<a href="{{route('users.edit', $user->id)}}" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 			</td>
					 			<td>	
					 				<form action="{{ route('users.destroy', $user->id)}}" method="post" onsubmit="confirm('Tem certeza que deseja excluir?')">
                  					@csrf
                  					@method('DELETE')
                  						<button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                					</form>
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