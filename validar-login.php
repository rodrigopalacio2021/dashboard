<?php
//CRIAR SESSÃO PARA A VARIÁVEL GLOBAL(TODAS AS PÁGINAS TERÃO ACESSOS A ESSAS VARIÁVEIS)
session_start(); //SESSION_START IRÁ FAZER A CONEXÃO LOGIN COM O VALIDAR-LOGIN



//VERIFICA SE ESTÁ VINDO INFORMAÇÕES
// PARA VALIDAÇÃO DE E-MAIL E SENHA
if ($_POST) {
    //VERIFICAR SE FOI ENVIADO OS CAMPOS OBRIGATÓRIOS
    if (empty($_POST["email"]) || empty($_POST["senha"])) {
        $_SESSION["msg"] = "Por favor, preencha os campos obrigatórios";
        $_SESSION["tipo"] = "Warning";

        header("location: login.php");

        exit;
    } else {
        include('./conexao_mysqli.php');
        $email = trim($_POST["email"]);
        $senha = trim($_POST["senha"]);

        //MONTAR SINTAXE SQL PARA CONSULTAR NO BANCO DE DADOS
        $sql = "
        SELECT pk_usuario, nome
        FROM usuarios
        WHERE email LIKE '$email' 
        AND senha LIKE  '$senha' 
              
        ";
        $query = mysqli_query($conn, $sql);

        // VERIFICAR SE ENCONTROU ALGUM REGISTRO NA TABELA
        if (mysqli_num_rows($query) > 0) {

            //ORGANIZA OS DADOS DO BANCO COMO OBJETOS NA VARIÁVEL $ROW
            $row = mysqli_fetch_object($query);

            //CRIAR SESSÃO PARA VARIÁVEL GLOBAL
            session_start();

            //DECLARO VARIÁVEL GLOBAL INFORMANDO QUE USUÁRIO
            //ESTÁ AUTENTICADO CORRETAMENTE
            $_SESSION["autenticado"] = true;
            $_SESSION["pk_usuario"] = $row->pk_usuario;
            $_SESSION["nome_usuario"] = $row->nome;
            $_SESSION["tempo_login"] = time();


            header('location: ./crud_mysqli');
            exit;
        } else {
            echo "
         <script>
          alert('E-mail e/ou senha inválidos!');
          window.location='./tela_login.php';
         </script>
          ";
            exit;
        }
    }
} else {
    header('Location: ./tela_login.php');
    exit;
}
