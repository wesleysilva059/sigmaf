@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Tipo de Troca de Filtros
@endsection
@section('main-content')
	@if(isset($dfilterChangeType))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('filterChangeTypes.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
	<label for="name">Tipo de Troca de Filtro</label>
	<input type="text" class="form-control" id="name" name="name" value="{{$filterChangeTypes->name or old('name')}}" required>
	<br>
	<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection
