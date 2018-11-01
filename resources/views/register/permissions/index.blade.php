@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Permissões
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ URL::to('gestao/alunos/create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Adicionar Permissão
 		</button>
 		</a><br><br>
 	</div>
 	<br><br>
 	<div class="box box-primary">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="permissions-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Nome</th>
					 		</tr>
					 	</thead>
					 </table>
 				</div>
 			</div>
 		</div>
 	</div>
 @endsection