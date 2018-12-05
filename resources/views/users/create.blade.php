@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Usuários
@endsection
@section('main-content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('users.store')}}" method="post" data-toggle="validator">	  
    {{ csrf_field() }}
    <!-- area de campos do form -->	  
	<hr />	  
        <div class="row">	    
			<div class="form-group col-md-8">	      
				<label for="name">Nome Completo</label>	      
				<input type="text" class="form-control" name="name" required>
			</div>	
    		<div class="form-group col-md-4">
    			<label for="birthDate">Data de Nascimento</label>
    			<input type="date" class="form-control" name="birthDate" required>
    		</div>	  
    	</div>	  	  
    	<div class="row">	    
    		<div class="form-group col-md-5">	      
    			<label for="username">Nome de Usuário</label>	      
    			<input type="text" class="form-control" name="username">
    		</div>	
    		<div class="form-group col-md-7">	      
    			<label for="email">E-mail</label>	      
    			<input type="text" class="form-control" name="email" required>
    		</div>	    	    
    	</div>	  	  
    	<div class="row">	    
       		<div class="form-group col-md-6">	      
    			<label for="phone">Telefone Fixo</label>	      
    			<input type="text" class="form-control" name="phone">
    		</div>	    	    
    		<div class="form-group col-md-6">	      
    			<label for="celPhone">Telefone Celular</label>	      
    			<input type="text" class="form-control" name="celPhone">
    		</div>	    	    
    	</div>
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="occupation_id">Cargo</label>
                <select class="form-control" name="occupation_id"  required>
                    <option>Escolha...</option>
                    @foreach($occupation_list as $occupation)
                    <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                    @endforeach
                </select>         
                
            </div>              
            <div class="form-group col-md-6">         
                <label for="registration">Matrícula</label>          
                <input type="text" class="form-control" name="registration" required>
            </div>              
        </div>
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="department">Secretaria / Orgão</label>       
                <select class="form-control" name="department_id" required>
                    <option></option>
                    @foreach($department_list as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select> 
            </div>
            <div class="form-group col-md-6">         
                <label for="department_id">Status</label>         
                <select class="form-control" name="status" required>
                    <option>Escolha...</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>               
        </div>	
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="password">Senha</label>         
                <input type="password" data-minlength="6" class="form-control" id="password" name="password" required>
                <div class="help-block">Minimo de 6 caracteres</div>
            </div>              
            <div class="form-group col-md-6">         
                <label for="password_confirmation">Confirmar Senha</label>         
                <input type="password" class="form-control" name="password_confirmation" data-match="#password" data-match-error="As senhas não coincidem!" required>
                <div class="help-block with-errors"></div>
            </div>              
        </div>  	  
    	<div id="actions" class="row">	    
    		<div class="col-md-12">	      		
    			<button type="submit" class="btn btn-primary">Salvar</button>	      
    			<a href="index.php" class="btn btn-default">Cancelar</a>	    
    		</div>	  
    	</div>	
    </form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
@endsection