@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Funcionário
@endsection
@section('main-content')

<form action="{{route('employees.store')}}" method="post">	  
    {{ csrf_field() }}
    <!-- area de campos do form -->	  
	<hr />	  
        <div class="row">	    
			<div class="form-group col-md-8">	      
				<label for="name">Nome Completo</label>	      
				<input type="text" class="form-control" name="name">
			</div>
    	</div>	  	  
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="occupation_id">Cargo</label>
                <select class="form-control" name="occupation_id">
                    <option>Escolha...</option>
                    @foreach($occupation_list as $occupation)
                    <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                    @endforeach
                </select>         
            </div>              
            <div class="form-group col-md-6">         
                <label for="registration">Matrícula</label>          
                <input type="text" class="form-control" name="registration">
            </div>              
        </div>
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="department_id">Status</label>         
                <select class="form-control" name="status">
                    <option>Escolha...</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>               
        </div>  
    	<div id="actions" class="row">	    
    		<div class="col-md-12">	      		
    			<button type="submit" class="btn btn-primary">Salvar</button>	      
    			<a href="index.php" class="btn btn-default">Cancelar</a>	    
    		</div>	  
    	</div>	
    </form>

@endsection