<?php
include('../verificar-autenticidade.php');
include('../conexao-pdo.php');
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ordem de Servac | Clientes</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dist/plugins/fontawesome-free/css/all.min.css">
    <!-- Boostrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
   
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- iCheck -->
    <link rel="stylesheet" href="../dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="../dist/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("../nav.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include("../aside.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content mt-3">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de clientes</h3>
                                    <a href="./form.php" class="btn btn-primary float-end btn-sm ">
                                        Adicionar 
                                        <i class="bi bi-plus"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">CPF</th>
                                                <th class="text-center">Whatsapp</th>
                                                <th class="text-center">E-mail</th>
                                                <th class="text-center">Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-hover">
                                            <?php
                                            $sql = "
                                            SELECT pk_cliente, nome, cpf, whatsapp, email
                                            FROM clientes
                                            ORDER BY nome
                                            ";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();

                                            $dados = $stmt->fetchAll(PDO::FETCH_OBJ);

                                            foreach ($dados as $row) {
                                                echo '
                                                <tr>
                                                <td>' . $row->pk_cliente . '</td>
                                                <td class="text-center">' . $row->nome . '</td>
                                                <td class="text-center">' . $row->cpf . '</td>
                                                <td class="text-center">' . $row->whatsapp . '</td>
                                                <td class="text-center">' . $row->email . '</td>
                                                <td class="text-center">
                                                    <a 
                                                    href="form.php?ref=' . base64_encode($row->pk_cliente) . '
                                                    " class="btn btn-info btn-sm "><i class="bi bi-pencil-square"></i></a>
                                                    <a href="remover.php?ref=' . base64_encode($row->pk_cliente) . '
                                                    " class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                                ';
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        <?php include("../footer.php"); ?>
        <!-- /. Footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../dist/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../dist/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- overlayScrollbars -->
    <script src="../dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- ChartJS -->
    <script src="../dist/plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- SWeetAlert2 -->
    <script src="../dist/plugins/sweetalert2/sweetalert2.min.js"></script>
    <?php
    include("../sweet-alert-2.php");
    ?>

    <script>
        $(function() {
            // navbar-white navbar-light
            // sidebar-dark-primary

            $("#theme-mode").click(function() {
                var classMode = $("#theme-mode").attr("class")
                if (classMode == "fa fa-sun") {
                    $("body").removeClass("dark-mode");
                    $("#theme-mode").attr("class", "fa fa-moon")
                    $("#nav").removeClass("navbar-black navbar-dark")
                    $("#nav").addClass("navbar-white navbar-light")
                    $("#aside").removeClass("sidebar-dark-primary")
                    $("#aside").addClass("sidebar-light-primary")
                } else {
                    $("body").addClass("dark-mode")
                    $("#theme-mode").attr("class", "fa fa-sun")
                    $("#nav").removeClass("navbar-white navbar-light")
                    $("#nav").addClass("navbar-black navbar-dark")
                    $("#aside").removeClass("sidebar-light-primary")
                    $("#aside").addClass("sidebar-dark-primary")
                }
            })

        })
    </script>
</body>

</html>