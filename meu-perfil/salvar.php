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

        //sempre que quiser exibir uma array, usa-se o "VAR_DUMP" E PARA UMA STRING É O "ECHO".

        // VERIFICA SE EXISTE UMA FOTO A SER SALVA// ERRO 4 É QUANDO A FOTO NAO FOI SELECIONADA 
        if ($foto["error"] != 4) {
            // verificar se o arquivo é uma imagem
            $ext_permitidos = array(
                "bmp",
                "jpg",
                "jpeg",
                "png",
                "jtif",
                "tiff",

            );
            // ext_permitidos = ["bmp", "jpg", "jpeg", "png", "jtif", "tiff"];
            $extensao = pathinfo($foto["name"], PATHINFO_EXTENSION);
            //VERIFICA SE A EXTENSÃO DO ARQUIVO
            // CONTÉM NO ARRAY EXT_PERMITIDOS
            if (in_array($extensao, $ext_permitidos)) {
                //GERAR NOME ÚNICO PARA O ARQUIVO
                $novo_nome = hash("sha256", uniqid() . rand() . $foto["tmp_name"]) . "." . $extensao;

                //MOVER O ARQUIVO PARA A PASTA "FOTOS
                // COM O NOVO NOME
                move_uploaded_file($foto["tmp_name"], "fotos/$novo_nome");
                $update_foto = "foto = '$novo_nome'";

                $_SESSION["foto"] = $novo_nome;
            } else {
                $_SESSION["tipo"] = "error";
                $_SESSION["title"] = "Ops!";
                $_session["msg"] = "Arquivo de imagem NÃO permitido.";
                header("Location: ./");
                exit;
            }
        } else {
            $update_foto = "foto=foto";
        }


        try {
            if (empty($senha)) {
                $sql = "
                    UPDATE usuarios SET
                    nome = :nome,
                    email = :email,
                    $update_foto
                    WHERE pk_usuario = :pk_usuario
         ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pk_usuario', $pk_usuario);
            } else {
                $sql = "
            UPDATE usuarios SET
            nome = :nome,
            email = :email,
            senha = :senha,
            $update_foto
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

            //TRANFORMA STRING EM ARRAY, AONDE TIVER ESPAÇO " "
            $nome_usuario = explode(" ", $nome);

            //CONCATENA O PRIMEIRO NOME COM O SOBRENOME DO USUÁRIO
            //$_SESSION["nome_usuario"] = $row->nome;

            $_SESSION["nome_usuario"] = $nome_usuario[0] . " ". end($nome_usuario); //ESSA SINTAXE USA O ARRAY PARA QUEBRAR O SOBRENOME E NÃO DEIXAR O NOME INTEIRO
            $_SESSION["tempo_login"] = time();

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
