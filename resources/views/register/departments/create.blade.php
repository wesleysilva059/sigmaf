@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Secretarias / Orgãos
@endsection
@section('main-content')
	@if(isset($departament))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('departments.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
	<label for="name">Nome da Secretaria/Orgão</label>
	<input type="text" class="form-control" id="name" name="name" value="{{$departments->name or old('name')}}" required>
	<br>
	<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection
