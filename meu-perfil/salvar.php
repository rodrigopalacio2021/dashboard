<?php
include("../verificar-autenticidade.php");
include("../conexao-pdo.php");

// VERIFICAR SE ESTTÁ VINDO INFORMAÇÕES VIA  POST
if ($_POST) {
    // VERIFICA CAMPOS OBRIGATÓRIOS
    if (empty($_POST["nome"]) || empty($_POST["email"])) {
        $_SESSION["tipo"] = 'warning';
        $_SESSION["title"] = 'Ops!';
        $_SESSION["msg"] = 'Por favor, preencha os campos obrigatórios.';
        header("Location: ./");
        exit;
    } else {
        // RECUPERA INFORMAÇÕES PREENCHIDAS PELO USUÁRIO
        $pk_usuario = $_SESSION["pk_usuario"];
        $nome = trim($_POST["nome"]);
        $email = trim($_POST["email"]);
        $senha = trim($_POST["senha"]);
        $foto = $_FILES["foto"];

        try {
            if (empty($senha)) {
                $sql = "
         UPDATE usuarios SET
         nome = :nome,
         email = :email
         WHERE pk_usuario = :pk_usuario
         ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nomeo);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pk_usuario', $pk_usuario);
            } else {
                $sql = "
            UPDTATE usuarios SET
            nome = :nome,
            email = :email,
            senha = :senha
            WHERE pk_usuario = :pk_usuario
         ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha);
                $stmt->bindParam(':pk_usuario', $pk_usuario);
            }
            // EXECUTA INSERT OU UPDATE ACIMA
            $stmt->execute();

            $_SESSION["tipo"] = 'success';
            $_SESSION["title"] = 'Oba!';
            $_SESSION["msg"] = 'Registro salvo com sucesso!';
            header("Location: ./");
            exit;
        } catch (PDOException $ex) {
            $_SESSION["tipo"] = 'error';
            $_SESSION["title"] = 'Ops!';
            $_SESSION["msg"] = $ex;
            header("Location: ./");
        }
    }
}
