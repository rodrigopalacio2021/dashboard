<?php
// SEMPRE QUE A SESSÃO TIVE INICIADA E APARECER A MSG DE ERRO,COLOCAR O "@" PARA QUE ELE ENTENDA QUE A SESSÃO "SESSION_START" JÁ ESTÁ INICIADA
@session_start(); // INICIA A SESSÃO 
//ISSET VERIFICA SE a sessão foi iniciada 
if(isset($_SESSION["tipo"]) && isset($_SESSION["title"]) && isset($_SESSION["msg"])){
   echo"
   <script>
   $(function() {
    var Toast = Swal.mixin({
        toast: false,
        position: 'center',
        showConfirmButton: false,
        timer: 3000
      });
    
      Toast.fire({
        icon: '".$_SESSION["tipo"]."', 
        title: '".$_SESSION["title"]."',
        text: '".$_SESSION["msg"]."'
      });

    });
    </script>
    ";

    //APÓS EXIBIR A MENSAGEM, LIMPA AS VARIÁVEIS-----APAGA MENSAGEM DE SESSÃO "UNSET"
    unset($_SESSION["tipo"]);
    unset($_SESSION["msg"]);
    unset($_SESSION["title"]);
} 


?>