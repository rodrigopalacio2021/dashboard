<?php

include('./verificar-autenticidade.php');
// INICIAR A SESSÃO
session_start();
// DESTRUIR QUALQUER SESSÃO EXISTENTE

session_destroy();

header("location:" . caminhoURL. "/login.php"); // IRÁ FAZER O "LOGOUT" DO LOGIN
exit;

?>