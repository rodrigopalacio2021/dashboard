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
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      });

    });
    </script>
    ";
} 


?>