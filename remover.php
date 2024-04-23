<?php
include("../verificar_autenticidade.php");
include('../conexao_mysqli.php');
if (isset($_GET['ref'])) {
    $pk_servico = base64_decode(trim($_GET['ref']));

   



    //----------------------------- BLOCO DE CÓDIGO PARA REMOÇÃO DE USUÁRIO QUE TEM A ORDEM DE SERVIÇO-----------------------------------
    try {
        $sql = "
        DELETE FROM servicos
        WHERE pk_servico = :pk_servico
        ";
       $stmt = $conn->prepare($sql);
       $stmt->bindParam(':pk_servico', $pk_servico);
       
       $stmt->execute();
       $_SESSION["tipo"] = 'success';
       $_SESSION["title"] = 'Oba!';
       $_SESSION["msg"] = 'Registro removido com sucesso.';
       header("Location: ./");
       exit;
    } catch (PDOException  $e) {
       if ($e->getCode() == 1451){
        $_SESSION["tipo"] = 'warning';
       $_SESSION["title"] = 'Ops!';
       $_SESSION["msg"] = 'Não é possível remover, servico com ordem de serviço cadastrado.';
       header("Location: ./");
       exit;
       } 
      else{
        $_SESSION["tipo"] = 'error';
        $_SESSION["title"] = 'Ops!';
        $_SESSION["msg"] = $e->getMessage() ;
        header("Location: ./");
        exit;


      }
        
    }
 //----------------------------------------FIM DO BLOCO DE CÓDIGO COM O "TRY" E "CATCH"-------------------------------------------------------------

}