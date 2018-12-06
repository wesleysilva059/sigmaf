@extends('adminlte::layouts.app')
@section('contentheader_title')
 Gestão de Manutenções
@endsection
@section('main-content')
 	<div style="float:right;">
 		<a href="{{ route('maintenances.create') }}">
 		<button type="button" class="btn btn-block btn-primary">
 			<i class="fa fa-plus"></i> Cadastrar Manutenção
 		</button>
 		</a><br><br>
 	</div>
 <br><br>
 	<div class="box box-primary">
 		@if(session()->get('success'))
    		<div class="alert alert-success">
      			{{ session()->get('success') }}  
    		</div><br />
  		@endif
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="vehicles-table">
					 	<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Data de Início</th>
					 			<th>Placa</th>
					 			<th>Marca/Modelo</th>
					 			<th>Secretaria / Orgão</th>
					 			<th>Status</th>
					 			<th width="5%">Opções</th>
					 			<th width="5%"></th>
					 		</tr>
					 	</thead>
					 	@foreach($maintenances as $maintenance)
					 	<tbody>
					 		<tr>
					 			<th>{{ $maintenance->cod }}</th>
					 			<th>{{ $maintenance->formatedinitDateMaintenance}}</th>
					 			<th>{{ $maintenance->vehicle->vehiclePlate }}</th>
					 			<th>{{ $maintenance->vehicle->vehicleModel->make->name. ' / '. $maintenance->vehicle->vehicleModel->name}}</th>
					 			<th>{{ $maintenance->department->name }}</th>
					 			<th>{{ $maintenance->maintenanceStatus->name }}</th>
					 			<td>
					 				<a href="#" class="btn btn-info">
					 					<i class="fa fa-wrench"></i>
					 				</a>
					 			</td>
					 			<td>
					 				<a href="{{ route('maintenances.destroy', $maintenance->id)}}" class="btn btn-danger">
					 					<i class="fa fa-trash"></i>
					 				</a>
					 			</td>
					 			<td>
					 				<button type="button" class="btn btn-success" 
					 					data-id="{{$maintenance->id}}"
					 					data-cod="{{$maintenance->cod}}"
										data-vehicleplate="{{$maintenance->vehicle->vehiclePlate}}"
										data-expecteddateend="{{$maintenance->expectedDateEnd}}"
										data-toggle="modal" data-target="#modal">
					 					<i class="fa fa-flag-checkered"></i>
					 				</button>
					 			</td>

					 		</tr>
					 	</tbody>
					 	@endforeach
					 </table>
 				</div>
 			</div>
 		</div>
 	</div>

 <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="modalLabel">Finalizar Manutenção</h4>
	      	</div>
      		<div class="modal-body">
				<form action="{{ route('maintenance.finish', 'test')}}" method="post">
				{{method_field('patch')}}
				{{csrf_field()}}
					<input type="hidden" id="id" name="id" value="">
					<div class="row">	    
						<div class="form-group col-md-6">	      
							<label for="cod">Codigo</label>	      
							<input type="text" class="form-control" id="cod" name="cod" value="{{old('cod')}}" required>
						</div>	
					    <div class="form-group col-md-6">
					    	<label for="vehiclePlate">Placa</label>
					    	<input type="text" class="form-control" id="vehiclePlate" name="vehiclePlate" value="{{old('vehiclePlate')}}" required>
					    </div>	  
					</div>	  	  
					<div class="row">	    
					   	<div class="form-group col-md-5">	      
							<label for="expectedDateEnd">Data (Previsão)</label>	      
							<input type="date" class="form-control" id="expectedDateEnd" name="expectedDateEnd" value="{{old('expectedDateEnd')}}" required>
						</div>	
					</div>	  	  
				   	<div class="row">	    
					    <div class="form-group col-md-5">	      
					    	<label for="endDateMaintenance">Data (Termino)</label>	      
					    	<input type="date" class="form-control" id="endDateMaintenance" name="endDateMaintenance" value="{{old('endDateMaintenance')}}">
					    </div>	    	    	    	    
			    	</div>
			        <div class="row">       
			            <div class="form-group col-md-12">         
			                <label for="serviceDescRealized">Descrição Geral do Serviço Realizado</label>         
			                <textarea class="form-control" id="serviceDescRealized" name="serviceDescRealized" rows="5"></textarea>
					    </div>                           
					</div>
					<div class="row">
				    	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				    	<button type="submit" class="btn btn-primary">Gravar</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<script>
	
	  $('#modal').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget)
      var id = button.data('id')
      var cod = button.data('cod')
      var vehiclePlate = button.data('vehicleplate') 
      var date = button.data('expecteddateend')
      var modal = $(this)

      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #cod').val(cod);
      modal.find('.modal-body #vehiclePlate').val(vehiclePlate);
      modal.find('.modal-body #expectedDateEnd').val(date);
	})
</script>
@endsection