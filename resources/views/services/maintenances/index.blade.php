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
					 					data-myid="{{$maintenance->cod}}"
										data-vehiclePlate="{{$maintenance->vehicle->vehiclePlate}}"
										data-expectedDateEnd="{{$maintenance->expectedDateEnd}}"
										data-toggle="modal" 
					 					data-target="#myModal">
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

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">Finalizar Manutenção</h4>
	      	</div>
      		<div class="modal-body">
				<form action="" method="post">
				{{method_field('patch')}}
				{{csrf_field()}}	  
				<hr />	
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
<script type='text/javascript'>
	
	  $('#myModal').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) 
      console.log(button);
      var cod = button.data('myid')
      var vehiclePlate = button.data('vehiclePlate') 
      var datee = button.data('expectedDateEnd').split("/") 
      var expectedDateEnd = datee[2]+'-'+datee[1]+'-'+datee[0]
      var modal = $(this)

      console.log(cod,vehiclePlate,datee,expectedDateEnd);

		//

      modal.find('.modal-body #cod').val(cod);
      modal.find('.modal-body #vehiclePlate').val(vehiclePlate);
      modal.find('.modal-body #expectedDateEnd').val(expectedDateEnd);
	})
</script>
@stop