<?php
// INICIAR A SESSÃO
session_start();
// DESTRUIR QUALQUER SESSÃO EXISTENTE

session_destroy();

header("location: login.php"); // IRÁ FAZER O "LOGOUT" DO LOGIN
exit;

?>