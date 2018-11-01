@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Modelo de Veículos
@endsection
@section('main-content')
	@if(isset($vehicleModels))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('vehicleModels.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
		<label for="name">Modelo</label>
		<input type="text" class="form-control" id="name" name="name" value="{{$vehicleModels->name or old('name')}}" required>
		<label for="name">Fabricante</label>
		<input type="text" class="form-control" id="make_id" name="make_id" value="{{$vehicleModels->make_id or old('make_id')}}" required>
		<br>
		<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection
