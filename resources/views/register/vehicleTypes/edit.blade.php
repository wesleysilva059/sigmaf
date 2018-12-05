@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Tipos de Veículos
@endsection
@section('main-content')
	@if(isset($vehicleTypes))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('vehicleTypes.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
		<label for="name">Tipo de Veiculo</label>
		<input type="text" class="form-control" id="name" name="name" value="{{$vehicleTypes->name or old('name')}}" required>
		<label for="name">Porte</label>
		<input type="text" class="form-control" id="vehicleSize" name="vehicleSize" value="{{
			$vehicleTypes->vehicleSize or old('vehicleSize')}}" required>
		<br>
		<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection
