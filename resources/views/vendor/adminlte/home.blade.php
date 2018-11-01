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
                    <th>ID</th>
                    <th>Placa</th>
                    <th>Dias</th>
                    <th>Previsão</th>
                    <th>Secretaria/Orgão</th>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>JJJ-1234</td>
                    <td>10</td>
                    <td>30/10/2018</span></td>
                    <td>Secretaria de Obras</td>
                  </tr>
                   <tr>
                    <td>3</td>
                    <td>ERF-7485</td>
                    <td>15</td>
                    <td>05/11/2018</span></td>
                    <td>Secretaria de Educação</td>
                  </tr>
                   <tr>
                    <td>4</td>
                    <td>AHJ-4488</td>
                    <td>5</td>
                    <td>25/10/2018</span></td>
                    <td>Gabinete</td>
                  </tr>
                   <tr>
                    <td>5</td>
                    <td>JHJ-4321</td>
                    <td>30</td>
                    <td>20/11/2018</span></td>
                    <td>Secretaria de Desenvolvimento Social</td>
                  </tr>
                </tbody>
              </table>
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
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        '10',
                        '20',
                        '30',
                    ],
                    backgroundColor: [
                        window.chartColors.red,
                        window.chartColors.yellow,
                        window.chartColors.green,
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Parado',
                    'Em manutenção',
                    'Ativo',
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