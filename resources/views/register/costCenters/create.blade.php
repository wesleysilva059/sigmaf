@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Centros de Custo
@endsection
@section('main-content')
	@if(isset($costCenter))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('costCenters.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field() }}
	<div class="col-md-6">	
		<label for="name">Nome do Centro de Custo</label>
		<input type="text" class="form-control" id="name" name="name" value="{{$costCenters->name or old('name')}}" required>
		<br>
		<label for="name">Secretaria / Orgão</label>
		<input type="text" class="form-control" id="department_id" name="department_id" value="{{$costCenters->department_id or old('name')}}" required>
		<br>
		<button type="submit" class="btn btn-success">Cadastrar</button>
	</div>
	</form>
@endsection
