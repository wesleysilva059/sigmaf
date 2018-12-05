@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Fabricante de Veículos
@endsection
@section('main-content')
	@if(isset($make))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('makes.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
	<label for="name">Nome da Fabricante</label>
	<input type="text" class="form-control" id="name" name="name" value="{{$makes->name or old('name')}}" required>
	<br>
	<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection
