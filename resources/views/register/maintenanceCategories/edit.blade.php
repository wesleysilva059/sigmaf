@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Categorias de Manutenção
@endsection
@section('main-content')
	@if(isset($maintenanceCategories))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('maintenanceCategories.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
	<div class="row">	    
		<div class="form-group col-md-8">	      
			<label for="name">Nome da Categoria</label>	      
			<input type="text" class="form-control" id="name" name="name" alue="{{$maintenanceCategories->name or old('name')}}" required>
		</div>	  
	</div>

	<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection
