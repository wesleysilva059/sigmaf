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
			<input type="text" class="form-control" id="name" name="name" value="{{$machineShops->name or old('name')}}" required>
		</div>	  
	</div>	
	<div class="row">
		<div class="form-group col-md-8">
			<label for="address">Endereço</label>
			<input type="text" class="form-control" id="address" name="address" value="{{$machineShops->address or old('address')}}" required>
		</div>
	</div>
	<div class="row">	    
		<div class="form-group col-md-4">	      
			<label for="state">Estado</label>
			<select class="form-control state" id="state" name="state" required>
                <option value="31">Minas Gerais</option>
                @foreach($state_list as $state)
                <option value="{{$state->id}}">{{$state->name}}</option>
				@endforeach
            </select>	      

		</div>
		<div class="form-group col-md-4">	      
			<label for="city_id">Cidade</label>	      
			<select class="form-control city_id" id="city_id" name="city_id" required>
            	<option value=3112802>Capitólio</option>
            </select>
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

<script>
	$(document).ready(function(){
		$('#state_id').change(function(){
			var state_id = $(this).val();
			$.getJSON('/getCities/' + state_id, function( dados ){
            	var option = '<option>Selecione o Modelo</option>';
            	$.each(dados, function(i, obj){
                	option += '<option value="'+obj.id+'">'+obj.name+'</option>';
              		})
       
           		$('#city_id').html(option).show();

			});
		});
	});
</script>
@endsection
