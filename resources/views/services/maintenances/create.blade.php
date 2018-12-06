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
					<div class="form-group col-md-2">	      
						<label for="cod">Codigo</label>	      
						<input type="text" class="form-control" id="cod" name="cod" value="{{$codNextMaintenance}}" readonly="readonly">
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
						    	<input type="hidden" name="vehicle_id" value="">
						   </div><!-- /input-group -->
						 </div><!-- /.col-lg-6 -->
		    		<div class="form-group col-md-4">	      
		    			<label for="initDateMaintenance">Data Inicial do Chamado</label>
						<input type="date" class="form-control" name="initDateMaintenance" id="initDateMaintenance" value="" required>
		    		</div>		  
		    	</div>	  	  
		    	<div class="row">	    
		    		<div class="col-md-4">	      
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
		    		<div class="col-md-4">	      
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
		    		<div class="form-group col-md-4">	      
		    			<label for="priority">Prioridade</label>   
		    			<select class="form-control" name="priority" id="priority" required>
		                    <option>Escolha...</option>
		                    <option value="0">Baixa</option>
		                    <option value="1">Média</option>
		                    <option value="2">Alta</option>
		                    <option value="3">Urgente</option>
		                </select> 
		    		</div>		  
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-6">	      
		    			<label for="maintenanceCategory_id">Categoria de manutenção</label>   
		    			<select class="form-control" name="maintenanceCategory_id" id="maintenanceCategory_id" required>
		                    <option>Escolha...</option>
		                    @foreach($maintenanceCategory_list as $maintenanceCategory)
		                    <option value="{{$maintenanceCategory->id}}">{{$maintenanceCategory->name}}</option>
							@endforeach
		                </select> 
		    		</div>
		    		<div class="form-group col-md-6">	      
		    			<label for="maintenanceStatus_id">Status Inicial</label>	     <select class="form-control" name="maintenanceStatus_id" id="maintenanceStatus_id" required>
		                    <option>Escolha...</option>
		                    @foreach($maintenanceStatus_list as $maintenanceStatus)
		                    <option value="{{$maintenanceStatus->id}}">{{$maintenanceStatus->name}}</option>
							@endforeach
		                </select> 
		    		</div>		  
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-4">	      
		    			<label for="department_id">Secretaria / Orgão</label>	     
		    			<select class="form-control" name="department_id" id="department_id" required>
		                    <option>Escolha...</option>
		                    @foreach($department_list as $department)
		                    <option value="{{$department->id}}">{{$department->name}}</option>
							@endforeach
		                </select> 
		    		</div>	    	    
		    		<div class="form-group col-md-4">	      
		    			<label for="costCenter_id">Centro de Custo</label>	      
		    			<select class="form-control" name="costCenter_id" id="costCenter_id" required>
		                </select> 
		    		</div>
		    		<div class="form-group col-md-4">	      
		    			<label for="currentKmHr">Km / Hr Atual</label>
						<input type="text" class="form-control" id="currentKmHr" name="currentKmHr" value="{{$currentKmHr or old('currentKmHr')}}" required>
		    		</div>
		    	</div>	  	  
		    	<div class="row">	    
		    		<div class="form-group col-md-10">	      
		    			<label for="story">Relato Inicial</label>	      
		    			<textarea class="form-control" id="story" name="story" rows="2"></textarea>
		    		</div>		  
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-10">	      
		    			<label for="plannedMaintenance">Manutenção Prevista</label>	      
		    			<textarea class="form-control" id="plannedMaintenance" name="plannedMaintenance" rows="2"></textarea>
		    		</div> 
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-6">	      
		    			<label for="provider_id">Fornecedor Peças</label>	     
		    			<select class="form-control" name="provider_id" id="provider_id" required>
		                    <option>Escolha...</option>
		                    @foreach($provider_list as $provider)
		                    <option value="{{$provider->id}}">{{$provider->name}}</option>
							@endforeach
		                </select> 
		    		</div>
		    		<div class="form-group col-md-6">	      
		    			<label for="machineShop_id">Oficina</label>	     
		    			<select class="form-control" name="machineShop_id" id="machineShop_id" required>
		                    <option>Escolha...</option>
		                    @foreach($machineShop_list as $machineShop)
		                    <option value="{{$machineShop->id}}">{{$machineShop->name}}</option>
							@endforeach
		                </select> 
		    		</div>  
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-4">	      
		    			<label for="expectedDateEnd">Data de Previsão(Término)</label>
						<input type="date" class="form-control" name="expectedDateEnd" id="expectedDateEnd" value="" required>
		    		</div>
		    	</div>
		    	<div id="actions" class="row">	    
	    		<div class="col-md-12">	      		
	    			<button type="submit" class="btn btn-primary">Salvar</button>	      
	    			<a href="{{route('maintenances.index')}}" class="btn btn-default">Cancelar</a>	    
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
 					<th>Deparmento</th>
 				</tr> 
 			</thead>
 			<tbody> 
               @foreach($vehicles_list as $vehicle) 
 				<tr> 
 					<td>{{$vehicle->id}}</td> 
 					<td>{{$vehicle->vehiclePlate}}</td> 
 					<td>{{$vehicle->vehicleModel->name}}</td> 
 					<td>{{$vehicle->costCenter->department->name}}</td>
 					<td style="visibility: hidden;">{{$vehicle->costCenter->department->id}}</td>
 					<td style="visibility: hidden;">{{$vehicle->costCenter_id}}</td>
 					<td style="visibility: hidden;">{{$vehicle->costCenter->name}}</td> 
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
               var op = '<option value="'+selitem[4].innerHTML+'">'+selitem[3].innerHTML+'</option>';
               $('#department_id').html(op).show();
               var department_id = selitem[3].innerHTML;
               $.getJSON('/getCostCenters/' + department_id, function( dados ){
            	var option = '<option value="'+selitem[5].innerHTML+'">'+selitem[6].innerHTML+'</option>';
            	$.each(dados, function(i, obj){
                	option += '<option value="'+obj.id+'">'+obj.name+'</option>';
              		})
       
           		$('#costCenter_id').html(option).show();

			});
               $('#myModal').modal('hide');
          });
     });

</script>

@endsection

