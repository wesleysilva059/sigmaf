@extends('adminlte::layouts.app')

@section('contentheader_title')
	Cadastro de Veículos
@endsection

@section('main-content')


<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row">
		<section>
        <div class="wizard col-md-10">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-log-in"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-briefcase"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-wrench"></i>
                            </span>
                        </a>
                    </li>
					<li role="presentation" class="disabled">
                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form role="form" action="{{route('vehicles.update', $vehicle->id)}}" method="post" data-toggle="validator">
                {{method_field('patch')}}
                {{ csrf_field() }}
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
  
						<!-- area de campos do form -->	  
						<hr />	  
						
							<div class="row">	    
								<div class="form-group col-md-2">	      
									<label for="vehicle_id">Codigo</label>	      
									<input type="text" class="form-control" id="vehicle_id" name="vehicle_id" value="{{$vehicle->id}}" disabled>
								</div>	
					    		<div class="form-group col-md-2">
					    			<label for="vehiclePlate">PLACA</label>
					    			<input type="text" class="form-control" id="vehiclePlate" name="vehiclePlate" value="{{$vehicle->vehiclePlate}}" required>
					    		</div>	
					    		<div class="form-group col-md-4">	      
					    			<label for="make_id">Marca</label>
					    			<select class="form-control make_id" id="make_id" name="make_id" required>
					                    <option value="{{$vehicle->vehicleModel->make->id}}">{{$vehicle->vehicleModel->make->name}}</option>
					                    @foreach($make_list as $make)
					                    <option value="{{$make->id}}">{{$make->name}}</option>
										@endforeach
					                </select>	      

					    		</div>
					    		<div class="form-group col-md-4">	      
					    			<label for="vehicleModel_id">Modelo</label>	      
					    			<select class="form-control vehicleModel_id" id="vehicleModel_id" name="vehicleModel_id" required>
					                	<option value="{{$vehicle->vehicleModel->id}}">
					                		{{$vehicle->vehicleModel->name}}</option>
					                </select>
					    		</div>	  
					    	</div>	  	  
					    	<div class="row">	    
					    		<div class="form-group col-md-3">	      
					    			<label for="vehicleColor">Cor</label>	      
					    			<input type="text" class="form-control" id="vehicleColor" name="vehicleColor" value="{{$vehicle->vehicleColor or old('vehicleColor')}}" required>
					    		</div>	
					    		<div class="form-group col-md-3">	      
					    			<label for="yearModel">Ano Modelo</label>	      
					    			<select class="form-control" id="yearModel" name="yearModel" required>
					                    <option value="{{$vehicle->yearModel}}">{{$vehicle->yearModel}}</option>
					                    @for($i = 1;$i <= 30; $i++)
					                    	<option value="{{$currentYear - $i}}">{{$currentYear - $i}}</option>
					                    @endfor
					                </select>
					    		</div>	    	    
					    		<div class="form-group col-md-3">	      
					    			<label for="yearManufactory">Ano Fabricação</label>	      
					    			<select class="form-control" id="yearManufactory" name="yearManufactory" required>
					                    <option value="{{$vehicle->yearManufactory}}">{{$vehicle->yearManufactory}}</option>
					                    @for($i = 1;$i <= 30; $i++)
					                    	<option value="{{$currentYear - $i}}">{{$currentYear - $i}}</option>
					                    @endfor
					                </select>
					    		</div>	    	    
					    		<div class="form-group col-md-3">	      
					    			<label for="vehicleType_id">Tipo de Veículo</label>	      
					    			<select class="form-control" id="vehicleType_id" name="vehicleType_id" required>
					                    <option value="{{$vehicle->vehicleType_id}}">{{$vehicle->vehicleType->name}}</option>
					                    @foreach($vehicleType_list as $vehicleType)
					                    <option value="{{$vehicleType->id}}">{{$vehicleType->name}}</option>
										@endforeach
					                </select>
					    		</div>	  
					    	</div>	  	  
					    	<div class="row">	    
					    		<div class="form-group col-md-4">	      
					    			<label for="purchaseDate">Data de Aquisição</label>
    								<input type="date" class="form-control" name="purchaseDate" id="purchaseDate" value="{{$vehicle->purchaseDate or old('purchaseDate')}}">
					    		</div>	    	    
					    		<div class="form-group col-md-4">	      
					    			<label for="renavam">Renavam</label>	      
					    			<input type="text" class="form-control" id="renavam" name="renavam" value="{{$vehicle->renavam or old('renavam')}}">
					    		</div>	    	    
					    		<div class="form-group col-md-4">	      
					    			<label for="chassis">Chassi</label>	      
					    			<input type="text" class="form-control" id="chassis" name="chassis" value="{{$vehicle->chassis or old('chassis')}}">
					    		</div>		  
					    	</div>
					    	<div class="row">	    
					    		<div class="form-group col-md-4">	      
					    			<label for="typeFuel">Combustível</label>	      
					    			<select class="form-control" name="typeFuel" id="typeFuel">
					                    <option value="{{$vehicle->typeFuel}}">{{$vehicle->formatedtypeFuel}}</option>
					                    <option value="1">Gasolina</option>
					                    <option value="2">Alcool</option>
					                    <option value="3">Bi-Combustível</option>
					                    <option value="4">Diesel</option>
					                    <option value="5">Diesel S10</option>
					                </select> 
					    		</div>	    	    
					    		<div class="form-group col-md-4">	      
					    			<label for="typeControl">Controle por:</label>	      
					    			<select class="form-control" name="typeControl" id="typeControl" required>
					                    <option value="{{$vehicle->typeControl}}">{{$vehicle->formatedtypeControl}}</option>
					                    <option value="0">Km</option>
					                    <option value="1">Hr</option>			                    
					                </select> 
					    		</div>	  
					    	</div>
					    	<div class="row">	    
					    		<div class="form-group col-md-4">	      
					    			<label for="department">Secretaria / Orgão</label>	     <select class="form-control" name="department" id="department" required>
					                    <option value="{{$vehicle->costCenter->department->id}}">{{$vehicle->costCenter->department->name}}</option>
					                    @foreach($department_list as $department)
					                    <option value="{{$department->id}}">{{$department->name}}</option>
										@endforeach
					                </select> 
					    		</div>	    	    
					    		<div class="form-group col-md-4">	      
					    			<label for="costCenter_id">Centro de Custo</label>	      
					    			<select class="form-control" name="costCenter_id" id="costCenter_id" required>
					    				<option value="{{$vehicle->costCenter_id}}">{{$vehicle->costCenter->name}}</option>
					                </select> 
					    		</div>	    	    
					    		<div class="form-group col-md-4">	      
					    			<label for="status">Status</label>	      
					    			<select class="form-control" name="status" id="status" required>
					                    <option value="{{$vehicle->status}}">{{$vehicle->formatedstatus}}</option>
					                    <option value="0">Ativo</option>
					                    <option value="1">Inativo</option>
					                    <option value="2">Em manutenção</option>
					                 	<option value="3">Doação</option>
					                    <option value="4">Leilão</option>
					                </select>
					    		</div>	  
					    	</div>

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Salvar e continuar</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
	  
						<!-- area de campos do form -->	  
						<hr />	  
						@foreach($insurance as $insurance)
							<div class="row">	    
								<div class="form-group col-md-2">	      
									<label for="name">Codigo do Veículo</label>	      
									<input type="text" class="form-control" value="{{$vehicle->id}}" disabled>
								</div>	
					    		<div class="form-group col-md-6">
					    			<label for="numInsurancePolicy">Numero Apolice</label>
					    			<input type="text" class="form-control" id="numInsurancePolicy" value="{{$insurance->numInsurancePolicy}}" name="numInsurancePolicy">
					    		</div>	  
					    	</div>	  	  
					    	<div class="row">	    
					    		<div class="form-group col-md-4">	      
					    			<label for="insurer">Seguradora</label>	      
					    			<input type="text" class="form-control" id="insurer" name="insurer" value="{{$insurance->insurer or old('insurer')}}">
					    		</div>	
					    		<div class="form-group col-md-4">	      
					    			<label for="insuranceBroker">Corretora de Seguro</label>	      
					    			<input type="text" class="form-control" id="insuranceBroker" name="insuranceBroker" value="{{$insurance->insuranceBroker or old('insuranceBroker')}}">
					    		</div>
					    	</div>	  	  
					    	<div class="row">	    
					    		<div class="form-group col-md-4">	      
					    			<label for="value">Valor</label>	      
					    			<input type="text" class="form-control" id="value" name="value" value="{{number_format($insurance->value, 2, ',','.')}}">
					    		</div>

					    		<div class="form-group col-md-4">	      
					    			<label for="initEffectiveDate">Data Vigência Inicial</label>
    								<input type="date" class="form-control" name="initEffectiveDate" id="initEffectiveDate" value="{{$insurance->initEffectiveDate or old('initEffectiveDate')}}">
					    		</div>	    	    
					    			    	    
					    		<div class="form-group col-md-4">	      
					    			<label for="endEffectiveDate">Data Vigência Final</label>
    								<input type="date" class="form-control" name="endEffectiveDate" id="endEffectiveDate" value="{{$insurance->endEffectiveDate or old('endEffectiveDate')}}">
					    		</div>		  
					    	</div>
						@endforeach
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Voltar</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Salvar e Continuar</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
 
						<!-- area de campos do form -->	  
						<hr />
						@foreach($specification as $specification)	  
							<div class="row">	    
								<div class="form-group col-md-2">	      
									<label>Codigo do Veículo</label>	      
									<input type="text" class="form-control" value="{{$vehicle->id}}" disabled>
								</div>
								<div class="form-group col-md-2">	      
									<label for="currentKmHr">Km/Hr Atual</label>	      
									<input type="text" class="form-control" name="currentKmHr" id="currentKmHr" value="{{$specification->currentKmHr}}">
								</div>
					    		<div class="form-group col-md-4">	      
					    			<label for="engine">Motorização</label>	      
					    			<input type="text" class="form-control" name="engine" id="engine" value="{{$specification->engine}}">
					    		</div>	
					    		<div class="form-group col-md-4">
					    			<label for="engineNumber">Numero do Motor</label>
					    			<input type="text" class="form-control" id="engineNumber" name="engineNumber" value="{{$specification->engineNumber}}">
					    		</div>  
					    	</div>	  	  
					    	<div class="row">	    
					    		<div class="form-group col-md-4">	      
					    			<label for="tyreWeight">Gramatura dos Pneus</label>	      
					    			<input type="text" class="form-control" id="tyreWeight" name="tyreWeight" value="{{$specification->tyreWeight or old('tyreWeight')}}">
					    		</div>	
					    		<div class="form-group col-md-4">	      
					    			<label for="frontTires">Pneus Dianteiros</label>	      
					    			<input type="text" class="form-control" id="frontTires" name="frontTires" value="{{$specification->frontTires or old('frontTires')}}">
					    		</div>
					    		<div class="form-group col-md-4">	      
					    			<label for="backTires">Pneus Traseiros</label>	      
					    			<input type="text" class="form-control" id="backTires" name="backTires" value="{{$specification->backTires or old('backTires')}}">
					    		</div>
					    	</div>	  	  
					    	<div class="row">	    
					    		<div class="form-group col-md-3">	      
					    			<label for="protector">Protetor</label>	      
					    			<input type="text" class="form-control" id="protector" name="protector" value="{{$specification->protector or old('protector')}}">
					    		</div>
					    		<div class="form-group col-md-3">	      
					    			<label for="innerTires">Camara de Ar</label>	      
					    			<input type="text" class="form-control" id="innerTires" name="innerTires" value="{{$specification->innerTires or old('innerTires')}}">
					    		</div>
					    		<div class="form-group col-md-3">	      
					    			<label for="frontCanvasPad">Lona Pastilha Dianteira</label>	      
					    			<input type="text" class="form-control" id="frontCanvasPad" name="frontCanvasPad" value="{{$specification->frontCanvasPad or old('frontCanvasPad')}}">
					    		</div>
					    		<div class="form-group col-md-3">	      
					    			<label for="backCanvasPad">Lona Pastilha Traseora</label>	      
					    			<input type="text" class="form-control" id="backCanvasPad" name="backCanvasPad" value="{{$specification->backCanvasPad or old('backCanvasPad')}}">
					    		</div>	  
					    	</div>
					    	<div class="row">	    
					    		<div class="form-group col-md-3">	      
					    			<label for="frontTambor">Tambor Dianteiro</label>	      
					    			<input type="text" class="form-control" id="frontTambor" name="frontTambor" value="{{$specification->frontTambor or old('frontTambor')}}">
					    		</div>
					    		<div class="form-group col-md-3">	      
					    			<label for="backTambor">Tambor Traseiro</label>	      
					    			<input type="text" class="form-control" id="backTambor" name="backTambor" value="{{$specification->backTambor or old('backTambor')}}">
					    		</div>
					    		<div class="form-group col-md-3">	      
					    			<label for="frontBumper">Amortecedor Dianteiro</label>	      
					    			<input type="text" class="form-control" id="frontBumper" name="frontBumper" value="{{$specification->frontBumper or old('frontBumper')}}">
					    		</div>
					    		<div class="form-group col-md-3">	      
					    			<label for="backBumper">Amortecedor Traseiro</label>	      
					    			<input type="text" class="form-control" id="backBumper" name="backBumper" value="{{$specification->backBumper or old('backBumper')}}">
					    		</div>	  
					    	</div>
					    	<div class="row">	    
								<div class="form-group col-md-4">	      
					    			<label for="vehicleBodywork">Carroceria</label>	      
					    			<input type="text" class="form-control" name="vehicleBodywork" id="vehicleBodywork" value="{{$specification->vehicleBodywork or old('vehicleBodywork')}}">
					    		</div>	
					    		<div class="form-group col-md-4">
					    			<label for="spring">Molas</label>
					    			<input type="text" class="form-control" id="spring" name="spring" value="{{$specification->spring or old('spring')}}">
					    		</div>  
					    	</div>
						@endforeach
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Voltar</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Salvar e continuar</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step4">

						<!-- area de campos do form -->	  
						<hr />	  
							<div class="row">	    
								<div class="form-group col-md-2">	      
									<label>Codigo do Veículo</label>	      
									<input type="text" class="form-control" value="{{$vehicle->id}}" disabled>
								</div>	  
					    	</div>	  	  
					    	<div class="row">	    
					    		<div class="form-group col-md-10">	      
					    			<label for="comments">Observações</label>	      
					    			<textarea class="form-control" id="comments" name="comments" rows="5" value="{{$vehicle->comments}}"></textarea>
					    		</div>	
					    	</div>	  	  
					    </form>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Voltar</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Salvar e Continuar</button></li>
                        </ul>
                    </div><div class="tab-pane" role="tabpanel" id="step5">
  
						<!-- area de campos do form -->	  
						<hr />	  
							<div class="custom-file">
							  	<input type="file" class="custom-file-input" id="customFileLang" lang="es">
							  	<label class="custom-file-label" for="customFileLang">Selecionar Arquivo</label>
							</div>	  	  

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Voltar</button></li>
                            <li><input type="submit" class="btn btn-primary next-step" value="Salvar e Continuar"></button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Completo, Aguarde um instante...</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
   </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
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