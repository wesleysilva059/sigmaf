@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Oficinas
@endsection
@section('main-content')
	@if(isset($machineShops))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('machineShops.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
	<div class="row">	    
		<div class="form-group col-md-8">	      
			<label for="name">Nome da Oficina</label>	      
			<input type="text" class="form-control" id="name" name="name" alue="{{$machineShops->name or old('name')}}" required>
		</div>	  
	</div>	
	<div class="row">
		<div class="form-group col-md-8">
			<label for="address">Endereço</label>
			<input type="text" class="form-control" id="address" name="address" value="{{$machineShops->address or old('address')}}" required>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-8">
			<label for="address">Telefone</label>
			<input type="text" class="form-control" id="phone" name="phone" value="{{$machineShops->phone or old('phone')}}" required>
		</div>
	</div>

	<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection
