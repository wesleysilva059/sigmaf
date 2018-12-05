@extends('adminlte::layouts.app')

@section('contentheader_title')
	Cadastro de Limpeza
@endsection

@section('main-content')

<script data-require="jquery" data-semver="2.1.4" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<form role="form" action="{{route('cleanings.store')}}" method="post">
    {{ csrf_field() }}
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="step1">

				<div class="row">	    
					<div class="form-group col-md-2">	      
						<label for="cod">ID</label>	      
						<input type="text" class="form-control" id="id" name="id" value="{{$idNextCleaning}}" disabled>
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
		    			<label for="date">Data</label>
						<input type="date" class="form-control" name="date" id="date" value="" required>
		    		</div>		  
		    	</div>	  	  
		    	<div class="row">	    
		    		<div class="form-group col-md-2">	      
		    			<label for="currentKmHr">Km / Hr Atual</label>
						<input type="text" class="form-control" id="currentKmHr" name="currentKmHr" value="{{$currentKmHr or old('currentKmHr')}}" required>
		    		</div>   
		    		<div class="form-group col-md-6">	      
		    			<label for="employee_id">Funcionário Responsável</label>	     
		    			<select class="form-control" name="employee_id" id="employee_id" required>
		                    <option>Escolha...</option>
		                    @foreach($employees_list as $employee)
		                    <option value="{{$employee->id}}">{{$employee->name}}</option>
							@endforeach
		                </select> 
		    		</div> 
		    	</div>
		    	<div class="row">	    
		    		<div class="form-group col-md-10">	      
		    			<label for="description">Descrição do Serviço</label>	      
		    			<textarea class="form-control" id="description" name="description" rows="2"></textarea>
		    		</div>		  
		    	</div>
	    		<div class="col-md-12">	      		
	    			<button type="submit" class="btn btn-primary">Salvar</button>	      
	    			<a href="{{route('cleanings.index')}}" class="btn btn-default">Cancelar</a>	    
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
 					<th>Id Dep.</th> 
 					<th>Deparmento</th> 
 				</tr> 
 			</thead>
 			<tbody> 
               @foreach($vehicles_list as $vehicle) 
 				<tr> 
 					<td>{{$vehicle->id}}</td> 
 					<td>{{$vehicle->vehiclePlate}}</td> 
 					<td>{{$vehicle->vehicleModel->name}}</td> 
 					<td>{{$vehicle->costCenter->department->id}}</td>
 					<td>{{$vehicle->costCenter->department->name}}</td> 
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

