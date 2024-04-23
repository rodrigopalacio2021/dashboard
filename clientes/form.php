
<?php
include('../verificar-autenticidade.php');
include('../conexao-pdo.php');

if (empty($_GET["ref"])) {
    $pk_cliente = "";
    $nome = "";
    $cpf = "";
    $whatsapp = "";
    $email = "";
} else {
    $pk_cliente = base64_decode(trim($_GET["ref"]));

    $sql = "
    SELECT pk_cliente, nome, cpf, whatsapp, email
    FROM clientes
    WHERE pk_cliente = :pk_cliente
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pk_cliente', $pk_cliente);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $dado = $stmt->fetch(PDO::FETCH_OBJ);
        $nome = $dado->nome;
        $cpf = $dado->cpf;
        $whatsapp = $dado->whatsapp;
        $email = $dado->email;
    } else {
        $_SESSION["tipo"] = 'error';
        $_SESSION["title"] = 'OPS!';
        $_SESSION["msg"] = 'Registro não encontrado';

        header("location: ./");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ordem de Servac | Cliente</title>

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
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../dist/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
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
                            <form method="post" action="salvar.php">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Cadastro do cliente</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="pk_cliente" class="form-label">ID:</label>
                                                    <input value="<?php echo $pk_cliente ?>" readonly type="number" name="pk_cliente" id="pk_cliente" class="form-control ">
                                                </div>
                                                <div class="col-md-10">
                                                    <label for="nome" class="form-label">Cliente:</label>
                                                    <input value="<?php echo $nome ?>" type="text" name="nome" id="nome" class="form-control" required>
                                                </div>

                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="cpf" class="form-label">CPF:</label>
                                                    <input value="<?php echo $cpf ?>" type="text" name="cpf" id="cpf" class="form-control" data-mask="000.000.000-00" required minlength="14">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="whatsapp" class="form-label">Whatsapp:</label>
                                                    <input value="<?php echo $whatsapp ?>" type="text" name="whatsapp" id="whatsapp" class="form-control" data-mask="(00) 00000-0000" required minlength="15">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="email" class="form-label">Email:</label>
                                                    <input value="<?php echo $email ?>" type="email" name="email" id="email" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-end ">
                                        <a href="./" class="btn btn-outline-danger">
                                            Voltar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            Salvar
                                        </button>
                                    </div>
                                </div>
                            </form>
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
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../dist/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
