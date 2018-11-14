@extends('adminlte::layouts.app')

@section('contentheader_title')
  Dashboard
@endsection

@section('main-content')

<div class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">ESTATÍSTICA</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
            <div class="box-body">
              <div id="canvas-holder">
                <canvas id="chart-area" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">MANUTENÇÕES EM ABERTO</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
           <div class="box-body" style="height:250px;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    
                    <th>Placa</th>
                    <th>Secretaria/Orgão</th>
                    <th>Data Inicial</th>
                    <th>Previsão</th>
                    <th>Dias</th>
                  </tr>
                  @foreach($maintenances as $maintenance)
                  <?php 
                      $initdate =    $maintenance->initDateMaintenance;
                      $enddate = $today;

                      $diff = strtotime($enddate) - strtotime($initdate);

                      $days = floor($diff / (60 * 60 * 24));
                  ?>
                  <tr>
                    <td>{{$maintenance->vehicle->vehiclePlate}}</td>
                    <td>{{$maintenance->department->name}}</td>
                    <td>{{$maintenance->formatedinitDateMaintenance}}</td>
                    <td>{{$maintenance->formatedexpectedDateEnd}}</span></td>
                    <td>{{$days}}</td>

                  </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $maintenances->links() !!}
            </div>
          <!-- LINE CHART -->
          
            <!-- /.box-body -->
      </div>            <!-- /.box-body -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">MENSAGENS</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
          <div class="box-body" style="height:250px;">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Remetente</th>
                  <th>Assunto</th>
                  <th>Status</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>John Doe</td>
                  <td>Limpeza FFF-1172</td>
                  <td><span class="label label-primary">Lido</span></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Alexander Pierce</td>
                  <td>Lubrificação ABC-1111</td>
                  <td><span class="label label-warning">Pendente</span></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Bob Doe</td>
                  <td>Troca Bateria CCC-1234</td>
                  <td><span class="label label-primary">Lido</span></td>
                </tr>
              </tbody></table>
            </div>    
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">ALERTAS</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
           <div class="box-body" style="height:250px;">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Placa</th>
                  <th>Descrição</th>
                  <th>Data</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>HKH-2345</td>
                  <td>Troca de Óleo do Motor</td>
                  <td>25/10/2018</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>KKK-3344</td>
                  <td>Troca do filtro de ar</td>
                  <td>25/10/2018</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>ABC-1341</td>
                  <td>Troca do filtro de Óleo</td>
                  <td>25/10/2018</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>GPL-3415</td>
                  <td>Troca de Óleo</td>
                  <td>30/10/2018</td>
                </tr>
              </tbody>
            </table>
          </div>
          
       </div>
    </div>
  </div>
</div>

    <script>
  /*
        var url = "{{url('chart')}}";
        var active;
        var inMaintenance;
        var stopped;
        var auction;
        $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
              active.push(data.active);
              inMaintenance.push(data.inMaintenance);
              stopped.push(data.stopped);
              auction.push(data.auction);
            });
            
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        active,
                        inMaintenance,
                        stopped,
                        auction
                    ],
                    backgroundColor: [
                        window.chartColors.green,
                        window.chartColors.yellow,
                        window.chartColors.red,
                        window.chartColors.orange,


                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Ativo',
                    'Em manutenção',
                    'Parado',
                    'Leilão'
                    
                ]
            },
            options: {
                responsive: true
            }
        };


        window.onload = function() {
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
        };
              });
        });
*/
        var active        =<?=$active?>;
        var inMaintenance =<?=$inMaintenance?>;
        var stopped       =<?=$stopped?>;
        var auction       =<?=$auction?>;
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        active,
                        inMaintenance,
                        stopped,
                        auction
                    ],
                    backgroundColor: [
                        window.chartColors.green,
                        window.chartColors.yellow,
                        window.chartColors.red,
                        window.chartColors.purple,
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Ativo',
                    'Em manutenção',
                    'Parado',
                    'Leilão'
                ]
            },
            options: {
                responsive: true
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
        };

    </script>


@endsection