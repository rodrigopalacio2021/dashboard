<?php
include("../verificar-autenticidade.php");
include("../conexao-pdo.php");


if ($_POST) {
    if (empty($_POST["nome"]) || empty($_POST["cpf"]) || strlen($_POST["cpf"]) != 14 || empty($_POST["email"])) {
        $_SESSION["tipo"] = 'warning';
        $_SESSION["title"] = 'OPS!';
        $_SESSION["msg"] = 'Por favor, preencha os campos obrigatórios';

        header("location: ./");
        exit;
    } else {
        $pk_cliente = trim($_POST["pk_cliente"]);
        $nome = trim($_POST["nome"]);
        $cpf = trim($_POST["cpf"]);
        $whatsapp = trim($_POST["whatsapp"]);
        $email = trim($_POST["email"]);

        try {
            if (empty($pk_cliente)) {
                $sql = "
                INSERT INTO clientes(nome, cpf, whatsapp, email) VALUES
                (:nome, :cpf,:whatsapp, :email)
            ";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':whatsapp', $whatsapp);
                $stmt->bindParam(':email', $email);
            } else {
                $sql = "
                UPDATE clientes SET
                nome = :nome,
                cpf = :cpf,
                whatsapp = :whatsapp,
                email = :email
                WHERE pk_cliente = :pk_cliente
            ";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':pk_cliente', $pk_cliente);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':whatsapp', $whatsapp);
                $stmt->bindParam(':email', $email);
            }
            $stmt->execute();

            $_SESSION["tipo"] = 'success';
            $_SESSION["title"] = 'Oba!';
            $_SESSION["msg"] = 'Registro salvo';
            header("location: ./");
            exit;
        } catch (PDOException $ex) {
            $_SESSION["tipo"] = 'error';
            $_SESSION["title"] = 'OPS!';
            $_SESSION["msg"] = $ex->getMessage();
            header("location: ./");
            exit;
        }
    }
}