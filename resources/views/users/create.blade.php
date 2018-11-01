@extends('adminlte::layouts.app')
@section('contentheader_title')
 Cadastro de Usuários
@endsection
@section('main-content')

<form action="{{route('users.store')}}" method="post">	  
    {{ csrf_field() }}
    <!-- area de campos do form -->	  
	<hr />	  
        <div class="row">	    
			<div class="form-group col-md-8">	      
				<label for="name">Nome Completo</label>	      
				<input type="text" class="form-control" name="name">
			</div>	
    		<div class="form-group col-md-4">
    			<label for="birthDate">Data de Nascimento</label>
    			<input type="date" class="form-control" name="birthDate">
    		</div>	  
    	</div>	  	  
    	<div class="row">	    
    		<div class="form-group col-md-5">	      
    			<label for="username">Nome de Usuário</label>	      
    			<input type="text" class="form-control" name="username">
    		</div>	
    		<div class="form-group col-md-7">	      
    			<label for="email">E-mail</label>	      
    			<input type="text" class="form-control" name="email">
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
                <label for="department">Secretaria / Orgão</label>       <select class="form-control" name="department_id" required>
                    <option>Escolha...</option>
                    @foreach($department_list as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select> 
            </div>
            <div class="form-group col-md-6">         
                <label for="department_id">Status</label>         
                <select class="form-control" name="status">
                    <option>Escolha...</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>               
        </div>	
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="password">Senha</label>         
                <input type="password" class="form-control" name="password">
            </div>              
            <div class="form-group col-md-6">         
                <label for="password_confirmation">Confirmar Senha</label>         
                <input type="password" class="form-control" name="password_confirmation">
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