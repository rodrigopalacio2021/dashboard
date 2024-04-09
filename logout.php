<?php

session_start();
// DESTRUIR QUALQUER SESSÃO EXISTENTE

session_destroy();

header("location: tela_login.php");
exit;

?>