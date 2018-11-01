@extends('adminlte::layouts.app')

@section('contentheader_title')
	Cadastro de Manutenções
@endsection

@section('main-content')


<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

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
		      							<input type="text" class="form-control" placeholder="Placa">
		  						    	<span class="input-group-btn">
		 						       		<button class="btn btn-default bt-test" type="button">	
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
        

<script>

	$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    	console.log($target);
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

	function nextTab(elem) {
	    $(elem).next().find('a[data-toggle="tab"]').click();
	}
	function prevTab(elem) {
	    $(elem).prev().find('a[data-toggle="tab"]').click();
	}

	$(document).ready(function(){
		$('#make_id').change(function(){
			var make_id = $(this).val();
			$.getJSON('/getVehicleModels/' + make_id, function( dados ){
            	var option = '<option>Selecione o Modelo</option>';
            	$.each(dados, function(i, obj){
                	option += '<option value="'+obj.id+'">'+obj.name+'</option>';
              		})
       
           		$('#vehicleModel_id').html(option).show();

			});
		});
	});

	$(document).ready(function(){
		$('#department').change(function(){
			var department_id = $(this).val();
			$.getJSON('/getCostCenters/' + department_id, function( dados ){
            	var option = '<option>Selecione o Centro de Custo</option>';
            	$.each(dados, function(i, obj){
                	option += '<option value="'+obj.id+'">'+obj.name+'</option>';
              		})
       
           		$('#costCenter_id').html(option).show();

			});
		});
	});


</script>

@endsection