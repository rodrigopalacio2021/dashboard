<!--O COMANDO "../" RECUA UMA PASTA, PARA PODE ACESSAR OS Arquivos dentro da pasta "dist"-->



<?php
include('../verificar-autenticidade.php'); //O COMANDO "INCLUDE" IRÁ INCLUIR OU LINKAR A PÁGINA "VERIFICAR-AUTENTICIDADE.PHP" COM O "INDEX.PHP".
include('../conexao-pdo.php'); //O COMANDO "INCLUDE" IRÁ INCLUIR OU LINKAR A PÁGINA "VERIFICAR-AUTENTICIDADE.PHP" COM O "INDEX.PHP".

$pagina_ativa = 'meu-perfil';

$pk_usuario = $_SESSION["pk_usuario"];




// MONTA A SINTAXE SQL PARA ENVIAR AO MYSQL
$sql = "
    SELECT nome, email, foto
    FROM usuarios
    WHERE pk_usuario = :pk_usuario
    ";
// PREPARA A SINTAXE
$stmt = $conn->prepare($sql);
// SUBSTITUI A STRING :PK_USUARIO PELA VARIÁVEL $PK_USUARIO
$stmt->bindParam(':pk_usuario', $pk_usuario);
// EXECUTA A SINTAXE FINAL NO MYSQL
$stmt->execute();
// VERIFICAR SE ENCONTROU ALGUM REGISTRO NO BANCO DE DADOS
if ($stmt->rowCount() > 0) {
    $dado = $stmt->fetch(PDO::FETCH_OBJ);
    $nome = $dado->nome;
    $email = $dado->email;
    $foto = $dado->foto;
} else {
    $_SESSION["tipo"] = 'error';
    $_SESSION["title"] = 'Ops!';
    $_SESSION["msg"] = 'Registro não encontrado.';
    header("Location: ./");
    exit;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SSS | Página Inicial</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dist/plugins/fontawesome-free/css/all.min.css">
    <!--Bootstrap 4-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="shortcut icon" href="./SSS.jpg" type="image/x-icon">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../SSS.jpg" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar   -->
        <?php include("../nav.php"); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include("../aside.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Main row -->


                    <!--===================================================================================================================================================-->
                    <div class="row mt-3">
                        <div class="col">
                            <form method="post" action="salvar.php" enctype="multipart/form-data">


                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Meu perfil</h3>

                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <img class="img-fluid rounded-circle" src="fotos/<?php echo $foto;?>" alt="minha foto" width="300" height="300">
                                            </div>
                                            <div class="col-md">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="nome" class="form-label">Nome</label>
                                                        <input required type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>"> <!--Obrigatório coolocar o "required"-->
                                                    </div>
                                                </div>

                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="email" class="form-label">E-mail</label>
                                                    <input required type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="senha" class="form-label">Senha</label>
                                                    <input type="password" class="form-control" id="senha" name="senha">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="foto" class="form-label">Foto de perfil</label>
                                                    <input type="file" class="form-control" id="foto" name="foto">
                                                </div>
                                            </div>
                                        </div>
            
                                    </div>

                                <!-- /.card-body -->
                                <div class="card-footer text-right">
                                    <a href="./" class="btn btn-outline-danger rounded-circle">
                                        <i class="bi bi-arrow-left"></i>
                                    </a>
                                    <button type="submit" class="btn btn-primary rounded-circle">
                                        <i class="bi bi-">Save</i>
                                    </button>
                                </div>
                        </div>
                        <!-- /.card -->
                        </form>
                    </div>
                </div>
                <!--=========================================================================================================================================-->



                <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("../footer.php"); ?>

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

    <!-- overlayScrollbars -->
    <script src="../dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert2 -->
    <script src="../disy/plugins/sweetalert2/sweetalert2.min.js"></script>

    <?php include('../sweet-alert-2.php'); ?>



    <!--===========================SINTAXE DO JAVASCRIPT PARA UTILIZAR O SCRIPT DO GRÁFICO==========================================-->
    <script>
        $(function() {

            //========================sintaxe jquery para configurar o theme-mode================================================
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
        })
        //=========================================================================================================================================
    </script>
    <!--=====================================================================================================================-->
</body>

</html>