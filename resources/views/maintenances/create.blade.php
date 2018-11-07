@extends('adminlte::layouts.app')

@section('contentheader_title')
	Cadastro de Manutenções
@endsection

@section('main-content')

<script data-require="jquery" data-semver="2.1.4" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<form role="form" action="{{route('maintenances.store')}}" method="post">
    {{ csrf_field() }}
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="step1">

				<div class="row">	    
					<div class="form-group col-md-4">	      
						<label for="maintenance_id">Codigo</label>	      
						<input type="text" class="form-control" id="maintenance_id" name="maintenance_id" value="{{$codNextMaintenance}}" disabled>
					</div>
		    		<div class="form-group col-md-4">
						   <div class="input-group">
  							<label for="plate">Placa do Veículo</label>
  							<input type="text" class="form-control" name="vehiclePlate" placeholder="Placa">
						    	<span class="input-group-btn">
						       		<button class="btn btn-block bt-test" type="button" data-toggle="modal" data-target="#myModal">	
						       			&#128269;
						       		</button>
						    	</span>
						    	<<input type="hidden" name="vehicle_id" value="">
						   </div><!-- /input-group -->
						 </div><!-- /.col-lg-6 -->
		    		<div class="form-group col-md-4">	      
		    			<label for="purchaseDate">Data Inicial do Chamado</label>
						<input type="date" class="form-control" name="initDateMaintenance" id="initDateMaintenance" value="" required>
		    		</div>		  
		    	</div>	  	  
		    	<div class="row">	    
		    		<div class="col-md-6">	      
		    			<p><b>Aquisição de Itens?</b></p>
		    			<div class="radio">
							<label><input type="radio" name="purchaseItem" value="1" checked>
								Sim
							</label>
						</div>
						<div class="radio">
						  	<label><input type="radio" name="purchaseItem" value="0">
						  		Não
						  </label>
						</div>
		    		</div>	
		    		<div class="col-md-6">	      
		    			<p><b>Prestação de Serviço</b></p>
		    			<div class="radio">
							<label><input type="radio" name="localService" value="1" checked>
								Oficina Propria
							</label>
						</div>
						<div class="radio">
						  	<label><input type="radio" name="localService" value="0">
						  		Oficina Terceirizada
						  </label>
						</div>
		    		</div>		  
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-6">	      
		    			<label for="department">Categoria de manutenção</label>	     <select class="form-control" name="department" id="department" required>
		                    <option>Escolha...</option>
		                    @foreach($maintenanceCategory_list as $maintenanceCategory)
		                    <option value="{{$maintenanceCategory->id}}">{{$maintenanceCategory->name}}</option>
							@endforeach
		                </select> 
		    		</div>	  
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-6">	      
		    			<label for="department">Centro de Custo do Veículo</label>	     <select class="form-control" name="costCenter" id="costCenter" required>
		                    <option></option>
		                </select> 
		    		</div>
		    		<div class="form-group col-md-6">	      
		    			<label for="department">Status Inicial</label>	     <select class="form-control" name="department" id="department" required>
		                    <option>Escolha...</option>
		                    @foreach($maintenanceStatus_list as $maintenanceStatus)
		                    <option value="{{$maintenanceStatus->id}}">{{$maintenanceStatus->name}}</option>
							@endforeach
		                </select> 
		    		</div>	  
		    	</div>	  	  
		    	<div class="row">	    
		    		<div class="form-group col-md-10">	      
		    			<label for="comments">Relato Inicial</label>	      
		    			<textarea class="form-control" id="comments" name="comments" rows="2"></textarea>
		    		</div>		  
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-10">	      
		    			<label for="comments">Manutenção Prevista</label>	      
		    			<textarea class="form-control" id="comments" name="comments" rows="2"></textarea>
		    		</div> 
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-6">	      
		    			<label for="department">Compra de Itens</label>	     <select class="form-control" name="department" id="department" required>
		                    <option>Escolha...</option>
		                    @foreach($provider_list as $provider)
		                    <option value="{{$provider->id}}">{{$provider->name}}</option>
							@endforeach
		                </select> 
		    		</div>
		    		<div class="form-group col-md-6">	      
		    			<label for="department">Oficina</label>	     <select class="form-control" name="department" id="department" required>
		                    <option>Escolha...</option>
		                    @foreach($machineShop_list as $machineShop)
		                    <option value="{{$machineShop->id}}">{{$machineShop->name}}</option>
							@endforeach
		                </select> 
		    		</div>  
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-4">	      
		    			<label for="purchaseDate">Data de Previsão(Término)</label>
						<input type="date" class="form-control" name="purchaseDate" id="purchaseDate" value="" required>
		    		</div>
		    	</div>
		    	<div id="actions" class="row">	    
	    		<div class="col-md-12">	      		
	    			<button type="submit" class="btn btn-primary">Salvar</button>	      
	    			<a href="index.php" class="btn btn-default">Cancelar</a>	    
	    		</div>	  
	    	</div>
        </div>
    </div>
</form>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      	<table id="vehicles" class="table row">
 			<thead> 
 				<tr> 
 					<th>#</th> 
 					<th>Placa do Veículo</th> 
 					<th>Modelo</th> 
 					<th>Centro de Custo</th> 
 				</tr> 
 			</thead>
 			<tbody> 
               @foreach($vehicles_list as $vehicle) 
 				<tr> 
 					<td>{{$vehicle->id}}</td> 
 					<td>{{$vehicle->vehiclePlate}}</td> 
 					<td>{{$vehicle->vehicleModel->name}}</td> 
 					<td>{{$vehicle->costCenter->name}}</td> 
 				</tr>  
 			@endforeach
               </tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnRowClick" class="btn btn-primary">Selecionar Veículo</button>
      </div>
    </div>
  </div>
</div>

<script>
     //Funçtion search in table inside modal
     $(function() {
          $('#vehicles > tbody > tr').on("click", function(event) {
               $(this).addClass('highlight').siblings().removeClass('highlight');
          });
          function getRow() {
               return $('table > tbody').find('.highlight'); 
          }
          $('#btnRowClick').click(function(e) {
               var selrow = getRow();
               var selitem = selrow[0];
               selitem = selitem.getElementsByTagName("td");
               //alert(selitem[1].innerHTML);
               $("input[name='vehiclePlate']").val(selitem[1].innerHTML);
               $("input[name='vehicle_id']").val(selitem[0].innerHTML);
               $('#myModal').modal('hide');
          });
     });

</script>

@endsection

