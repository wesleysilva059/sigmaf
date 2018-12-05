@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Tipo de Troca de Oléo
@endsection
@section('main-content')
	@if(isset($oilchangeType))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('oilChangeTypes.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
	<label for="name">Tipo de Troca de Oléo</label>
	<input type="text" class="form-control" id="name" name="name" value="{{$oilChangeTypes->name or old('name')}}" required>
	<br>
	<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection
