@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Statusas de Manutenção
@endsection
@section('main-content')
	@if(isset($maintenanceStatuses))
	<form action="#" method="post" class="form" enctype="multpart/form-data">

	@else
	<form action="{{route('maintenanceStatuses.store')}}" method="post" class="form" enctype="multpart/form-data">
	@endif
	{{ csrf_field()}}
	<div class="row">	    
		<div class="form-group col-md-8">	      
			<label for="name">Nome da Statusa</label>	      
			<input type="text" class="form-control" id="name" name="name" alue="{{$maintenanceStatuses->name or old('name')}}" required>
		</div>	  
	</div>

	<button type="submit" class="btn btn-success">Cadastrar</button>
	</form>
@endsection