<?php
//CRIAR SESSÃO PARA A VARIÁVEL GLOBAL(TODAS AS PÁGINAS TERÃO ACESSOS A ESSAS VARIÁVEIS)
session_start(); //SESSION_START IRÁ FAZER A CONEXÃO LOGIN COM O VALIDAR-LOGIN



//VERIFICA SE ESTÁ VINDO INFORMAÇÕES
// PARA VALIDAÇÃO DE E-MAIL E SENHA
if ($_POST) {
    //VERIFICAR SE FOI ENVIADO OS CAMPOS OBRIGATÓRIOS
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        $_SESSION["msg"] = "Por favor, preencha os campos obrigatórios";
        $_SESSION["tipo"] = "error"; // SE COLOCAR O "WARNING" IRÁ APARECER UM AVISO NA TELA, PARA PREENCHER OS CAMPOS COMO O "ERROR"
        $_SESSION["title"] = "Ops!"; // SE COLOCAR O "WARNING" IRÁ APARECER UM AVISO NA TELA, PARA PREENCHER OS CAMPOS COMO O "ERROR"

        header("Location: login.php");

        exit;
    } else {
        include('./conexao-pdo.php');

        //RECUPERAR INFORMAÇÕES DO FORMULÁRIO LOGIN
        $email = trim($_POST["email"]);
        $senha = trim($_POST["senha"]);

        //MONTAR SINTAXE SQL PARA CONSULTAR NO BANCO DE DADOS MYSQL
        $stmt = $conn->prepare("
        SELECT pk_usuario, nome
        FROM usuarios
        WHERE email LIKE :email  
        AND senha LIKE :senha  
              
        ");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        $stmt->execute();
        //$query = mysqli_query($conn, $sql); --------------SINTAXE USADA ANTERIORMENTE NO ARQUIVO" AULA_PHP

        if ($stmt->rowCount() > 0) {
            //ORGANIZA OS DADOS DO BANCO COMO OBJETOS NA VARIÁVEL $ROW
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            //DECLARO VARIÁVEL GLOBAL INFORMANDO QUE USUÁRIO
            //ESTÁ AUTENTICADO CORRETAMENTE

            $_SESSION["autenticado"] = true;
            $_SESSION["pk_usuario"] = $row->pk_usuario;

            //TRANFORMA STRING EM ARRAY, AONDE TIVER ESPAÇO " "
            $nome_usuario = explode(" ", $row->nome);

            //CONCATENA O PRIMEIRO NOME COM O SOBRENOME DO USUÁRIO
            //$_SESSION["nome_usuario"] = $row->nome;

            $_SESSION["nome_usuario"] = $nome_usuario[0] . " ". end($nome_usuario); //ESSA SINTAXE USA O ARRAY PARA QUEBRAR O SOBRENOME E NÃO DEIXAR O NOME INTEIRO
            $_SESSION["tempo_login"] = time();


            header('location: ./'); //IRÁ LINKAR COM A TELA PRINCIPAL "INDEX"
            exit;
        } else {

            $_SESSION["title"] = 'Ops!';
            $_SESSION["msg"] = 'E-mail e/ou senha inválidos!';
            $_SESSION["tipo"] = 'error';
            

            header('Location: login.php');
            exit;
        }
    }
} else {
    header('Location: ./login.php');
    exit;
}


       

        // VERIFICAR SE ENCONTROU ALGUM REGISTRO NA TABELA
        //if (mysqli_num_rows($query) > 0) {

            //ORGANIZA OS DADOS DO BANCO COMO OBJETOS NA VARIÁVEL $ROW
            //$row = mysqli_fetch_object($query);


            //DECLARO VARIÁVEL GLOBAL INFORMANDO QUE USUÁRIO
            //ESTÁ AUTENTICADO CORRETAMENTE
            /*$_SESSION["autenticado"] = true;
            $_SESSION["pk_usuario"] = $row->pk_usuario;
            $_SESSION["nome_usuario"] = $row->nome;
            $_SESSION["tempo_login"] = time(); */


            //header('location: ./crud_mysqli');
            //exit;
