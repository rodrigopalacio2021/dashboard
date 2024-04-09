<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SSS Senac system service</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/plugins/fontawesome-free/css/all.min.css">
  <!--Sweet alert2-->
  <link rel="stylesheet" href="dist/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h4"><b>SSS</b><br>Senac System Service</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Informe suas credenciais de acesso </p>

      <form action="validar-login.php" method="post">
        <div class="input-group mb-3">
          <input required type="email" class="form-control" placeholder="E-mail" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Senha" name="senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Lembrar-me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i> Entrar com a conta Google
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="esqueceu-senha.php">Esqueceu a senha?</a>
      </p>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--SweetAlert2-->
<script src="dist/plugins/sweetalert2/sweetalert2.min.css"></script>
<!-- AdminLTE App -->
<script src="dist/dist/js/adminlte.min.js"></script>

<?php include("sweet-alert-2.php");?>




</body>
</html>
