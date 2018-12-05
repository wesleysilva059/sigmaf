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
<form action="{{route('users.update', $user->id)}}" method="post">
    {{ method_field('patch')}}	  
    {{ csrf_field() }}
    <!-- area de campos do form -->	  
	<hr />	  
        <div class="row">	    
			<input type="hidden" value="{{$user->id}}">
            <div class="form-group col-md-8">	      
				<label for="name">Nome Completo</label>	      
				<input type="text" class="form-control" name="name" value="{{$user->name or old('name')}}">
			</div>	
    		<div class="form-group col-md-4">
    			<label for="birthDate">Data de Nascimento</label>
    			<input type="date" class="form-control" name="birthDate" value="{{$user->birthDate or old('birthDate')}}">
    		</div>	  
    	</div>	  	  
    	<div class="row">	    
    		<div class="form-group col-md-5">	      
    			<label for="username">Nome de Usuário</label>	      
    			<input type="text" class="form-control" name="username" value="{{$user->username or old('username')}}">
    		</div>	
    		<div class="form-group col-md-7">	      
    			<label for="email">E-mail</label>	      
    			<input type="text" class="form-control" name="email" value="{{$user->email or old('email')}}">
    		</div>	    	    
    	</div>	  	  
    	<div class="row">	    
       		<div class="form-group col-md-6">	      
    			<label for="phone">Telefone Fixo</label>	      
    			<input type="text" class="form-control" name="phone" value="{{$user->phone or old('phone')}}">
    		</div>	    	    
    		<div class="form-group col-md-6">	      
    			<label for="celPhone">Telefone Celular</label>	      
    			<input type="text" class="form-control" name="celPhone" value="{{$user->celPhone or old('celPhone')}}">
    		</div>	    	    
    	</div>
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="occupation_id">Cargo</label>
                <select class="form-control" name="occupation_id">
                    <option value="{{$user->occupation_id or old('occupation_id')}}">{{$user->occupation->name }}</option>
                    @foreach($occupation_list as $occupation)
                    <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                    @endforeach
                </select>         
                
            </div>              
            <div class="form-group col-md-6">         
                <label for="registration">Matrícula</label>          
                <input type="text" class="form-control" name="registration" value="{{$user->registration or old('registration')}}">
            </div>              
        </div>
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="department">Secretaria / Orgão</label>       <select class="form-control" name="department_id" required>
                    <option value="{{$user->department_id or old('department_id')}}">{{$user->department->name }}</option>
                    @foreach($department_list as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select> 
            </div>
            <div class="form-group col-md-6">         
                <label for="department_id">Status</label>         
                <select class="form-control" name="status">
                    <option value="{{$user->status or old('status')}}">{{$user->formatedstatus}}</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>               
        </div>	
        <div class="row">       
            <div class="form-group col-md-6">         
                <label for="password">Senha</label>         
                <input type="password" class="form-control" name="password" value="{{$user->password or old('password')}}">
            </div>              
            <div class="form-group col-md-6">         
                <label for="password_confirmation">Confirmar Senha</label>         
                <input type="password" class="form-control" name="password_confirmation" value="{{$user->password or old('password')}}">
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