@extends('adminlte::layouts.app')
@section('contentheader_title')
	Relatório de Manutenções por Veículo
@endsection
@section('main-content')
 	 <br><br>
 	<div class="box box-primary">
 		<div class="box-header">
            <form method="POST" name="actionJava"  class="form form-inline">
                {!! csrf_field() !!}
                <input type="text" name="vehiclePlate" class="form-control" placeholder="Placa">
                <input type="submit" class="btn btn-primary" value="Pesquisar" onclick="selecionaAction('{{route('maintenancesByCar.search')}}');">
            </form>
        </div>

 		<div class="row">
 			<div class="col-sm-12">
 				<div class="box-body">
 					<table class="table table-hover table-condensed"
						style="width:100%" id="employees-table">
					 	<thead>
					 		<tr>
					 			<th>Placa</th>
					 			<th>Secretaria</th>
					 			<th>Data de Registro</th>
					 			<th>Status</th>
					 			<th>Tipo</th>
					 		</tr>
					 	</thead>
					 	@foreach($historics as $historic)
					 	<tbody>
					 		<tr>
					 			<td>{{ $historic->vehicle->vehiclePlate }}</td>
					 			<td>{{ $historic->department->name }}</td>
					 			<td>{{ $historic->formatedinitDateMaintenance}}</td>
					 			<td>{{ $historic->maintenanceStatus->name}}</td>
					 			<td>{{ $historic->maintenanceCategory->name}}</td>
					 			<td>
					 				<a href="{{route('maintenances.show', $historic->id)}}" class="btn btn-info">
					 					<i class="fa fa-eye"></i>
					 				</a>
					 				<a href="{{route('maintenancesByCar.print', $historic->id)}}" class="btn btn-success">
					 					<i class="fa fa-print"></i>
					 				</a>
					 			</td>
					 		</tr>
					 	</tbody>
					 	@endforeach
					 </table>
					  @if(isset($dataForm))
					 	{!! $historics->appends($dataForm)->links() !!}
					 @else
					 	{!! $historics->links() !!}
					 @endif
 				</div>
 			</div>
 		</div>
 	</div>


 	<script>
 		function selecionaAction(script){
        document.actionJava.action = script;
        document.actionJava.submit();
    }

 	</script>
 @endsection