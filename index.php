<?php
include('verificar-autenticidade.php'); //O COMANDO "INCLUDE" IRÁ INCLUIR OU LINKAR A PÁGINA "VERIFICAR-AUTENTICIDADE.PHP" COM O "INDEX.PHP".
include('conexao-pdo.php'); //O COMANDO "INCLUDE" IRÁ INCLUIR OU LINKAR A PÁGINA "VERIFICAR-AUTENTICIDADE.PHP" COM O "INDEX.PHP".

$pagina_ativa = "home";

$sql = "
SELECT COUNT(pk_ordem_servico) total_os,
(
  SELECT COUNT(pk_cliente)
  FROM clientes
) total_clientes,
(
  SELECT COUNT(pk_servico)
  FROM servicos
  ) total_servicos,
  (
    SELECT COUNT(pk_ordem_servico)
    FROM ordens_servicos
    WHERE data_fim <> '0000-00-00'
    ) total_os_fechadas
    FROM ordens_servicos

";

try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $dados = $stmt->fetch(PDO::FETCH_OBJ);

  if ($dados->total_os == 0) {
    $porcentagem_os_concluida = 0;
  } else {
    $porcentagem_os_concluida = number_format((($dados->total_os_fechadas / $dados->total_os) * 100), 0);
  }
} catch (PDOException $ex) {
  $_SESSION["tipo"] = "error";
  $_SESSION["title"] = "Ops!";
  $_SESSION["msg"] = $ex->getMessage();
}
?>



<!DOCTYPE html>
<html lang="PT-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SSS | Página Inicial</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/plugins/fontawesome-free/css/all.min.css">
  <!--Bootstrap 4-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="shortcut icon" href="./SSS.jpg" type="image/x-icon">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src=".//SSS.jpg" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar   -->
    <?php include("nav.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("aside.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-lg">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Página inicial</h1>
            </div><!-- /.col -->
            <!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-gradient-info">
                <div class="inner">
                  <h3><?php echo $dados->total_os; ?></h3>

                  <p>Ordens de serviço</p>
                </div>
                <div class="icon">
                  <i class="bi bi-cash"></i>
                </div>
                <a href="./ordens" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-gradient-success">
                <div class="inner">
                  <h3><?php echo $porcentagem_os_concluida; ?><sup style="font-size: 20px">%</sup></h3>

                  <p>O.S. concluídas </p>
                </div>
                <div class="icon">
                  <i class="bi bi-graph-up-arrow"></i>
                </div>
                <a href="./ordens" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-gradient-warning">
                <div class="inner">
                  <h3><?php echo $dados->total_clientes; ?> </h3>

                  <p>Clientes</p>
                </div>
                <div class="icon">
                  <i class="bi bi-people"></i>
                </div>
                <a href="./clientes" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-gradient-danger">
                <div class="inner">
                  <h3><?php echo $dados->total_servicos; ?></h3>

                  <p>Serviços</p>
                </div>
                <div class="icon">
                  <i class="bi bi-tools"></i>
                </div>
                <a href="./servicos" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->


          <!--===================================================================================================================================================-->
          <div class="row">
            <div class="col">
              <!-- BAR CHART -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Bar Chart</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body bg-gradient-dark">
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!--=========================================================================================================================================-->



          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("footer.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="dist/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="dist/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Tempusdominus Bootstrap 4 -->
  <script src="dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- overlayScrollbars -->
  <script src="dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

  <!-- ChartJS  ========================================PLUGIN DO GRÁFICO==================================================-->
  <script src="dist/plugins/chart.js/Chart.min.js"></script>


  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->

  <script src="dist/js/pages/dashboard.js"></script>



  <!--===========================SINTAXE DO JAVASCRIPT PARA UTILIZAR O SCRIPT DO GRÁFICO==========================================-->
  <script>
    $(function() {

      //sintaxe jquery para configurar o theme-mode
      $("#theme-mode").click(function() {

        // pegar atributo "class" do objeto
        var classMode = $("#theme-mode").attr("class")
        if (classMode == "fas fa-sun") {
          $("body").removeClass("dark-mode");
          $("#theme-mode").attr("class", "fas fa-moon");
          $("#navTopo").attr("class", "main-header navbar navbar-expand navbar-white navbar-light");
          $("#asideMenu").attr("class", "main-sidebar sidebar-light-primary elevation-4");

        } else {
          $("body").addClass("dark-mode");
          $("#theme-mode").attr("class", "fas fa-sun");
          $("#navTopo").attr("class", "main-header navbar navbar-expand navbar-black navbar-dark");
          $("#asideMenu").attr("class", "main-sidebar sidebar-dark-primary elevation-4");
        }
      });


      <?php
      $sql = "
     SELECT COUNT(pk_ordem_servico) total_os,
     DATE_FORMAT(data_ordem_servico, '%b/%Y') mesAno,
     (
      SELECT COUNT(pk_ordem_servico)
      FROM ordens_servicos
      WHERE DATE_FORMAT(data_ordem_servico, '%m/%Y') = DATE_FORMAT(a.data_ordem_servico, '%m/%Y')
      AND data_fim <> '0000-00-00'
      ) total_concluidas
     FROM ordens_servicos a
     WHERE data_ordem_servico >= DATE_SUB(data_ordem_servico, INTERVAL 1 YEAR)
     GROUP BY DATE_FORMAT(data_ordem_servico,'%m/%Y')
     ORDER BY data_ordem_servico
     ";
      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_OBJ);

        $meses = array();
        $valores = array();
        foreach ($dados  as $key => $row) {
          array_push($meses, "'$row->mesAno'");
          array_push($valores, $row->total_os);
        }
      } catch (PDOException $e) {
        echo "console.log('" . $e->getMessage() . "');";
      }
      ?>

      //=========================================================================================================================================
      var areaChartData = {
        labels: [<?php echo implode(",", $meses); ?>],
        datasets: [{
            label: 'O.S. concluídas',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
          },
          {
            label: 'O.S. Total',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [<?php echo implode(",", $valores); ?>]
          },
        ]
      }

      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })

    });
  </script>
  <!--=====================================================================================================================-->
</body>

</html>