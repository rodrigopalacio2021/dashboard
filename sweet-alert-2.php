<?php

session_start();
//ISSET VERIFICA SE a sessão foi iniciada 
if(isset($_SESSION["tipo"]) && isset($_SESSION["msg"])){
   echo"
   <script>
   $(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    
      Toast.fire({
        icon: '".$_SESSION["tipo"]."', 
        title: '".$_SESSION["msg"]."',
      });

    });
    </script>
    ";
} 

?>