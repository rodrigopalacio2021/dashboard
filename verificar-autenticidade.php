<?php
session_start();


//VERIFICA SE O USUÁRIO NÃO ESTÁ CONECTADO
if($_SESSION["autenticado"] != true){
    // DESTRUIR QUALQUER SESSÃO EXISTENTE
session_destroy();

header("Location: ../tela_login.php");
exit;

}else{
   $tempo_limite = 10; // SEGUNDOS
   $tempo_atual = time();


   //ESSE BLOCO DE CÓDIGO IRÁ DETERMINAR O TEMPO DE LOGON NA TELA DE LOGIN
   //VERIFICAR TEMPO INATIVO DO USUÁRIO
   if(($tempo_atual - $_SESSION["tempo_login"]) > $tempo_limite){
    // DESTRUIR QUALQUER SESSÃO EXISTENTE
    session_destroy();

    echo"
    <script>
    alert('Tempo de sessão esgotado!');
    window.location='../tela_login.php';
    </script>
    
    ";
    //header("location: ../tela_login.php");
    exit;
   }else{
    $_SESSION["tempo_login"] = time();
   }
}

?>