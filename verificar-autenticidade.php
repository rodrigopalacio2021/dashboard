<?php
session_start();


//VERIFICA SE O USUÁRIO NÃO ESTÁ CONECTADO
if ($_SESSION["autenticado"] != true) {
    // DESTRUIR QUALQUER SESSÃO EXISTENTE
    session_destroy();

    header("Location: ./login.php");
    exit;
} else {
    $tempo_limite = 300; // SEGUNDOS
    $tempo_atual = time();


    //ESSE BLOCO DE CÓDIGO IRÁ DETERMINAR O TEMPO DE LOGON NA TELA DE LOGIN
    //VERIFICAR TEMPO INATIVO DO USUÁRIO
    if (($tempo_atual - $_SESSION["tempo_login"]) > $tempo_limite) {
        // DESTRUIR QUALQUER SESSÃO EXISTENTE
        //session_destroy(); irá destruir a sessão iniciada pelo isset

        $_SESSION["tipo"] = "warning";
        $_SESSION["title"] = "Ops!";
        $_SESSION["msg"] = "Tempo de sessão esgotado!";




        header("location: ./login.php");
        exit;
    } else {
        $_SESSION["tempo_login"] = time();
    }
}
