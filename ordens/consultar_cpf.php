<?php
// SEMPRE INICIA COM O  INCLUDE
include('../verificar-autenticidade.php');
include('../conexao-pdo.php');

// CONSULTAR VIA GET
// VERIFICA SE ESTÁ VINDO UM CPF NA URL
if(isset($_GET["cpf"])){
$cpf = trim($_GET["cpf"]);

$sql = "
SELECT nome
FROM clientes
WHERE cpf LIKE :cpf

";
 try{
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':cpf', $cpf);
   $stmt->execute();
   // VERIFICA SE ENCONTROU ALGUM CLIENTE
if($stmt->rowCount() > 0){

    $dado = $stmt->fetch(PDO::FETCH_OBJ);
    $success = true;
} else {
    $dado =  "Registro não encontrado";
    $success = false;

}

 } catch(PDOException $ex){
  $dado = $ex->getMessage();
  $success = false;

 }

 echo json_encode(array(
'success' => $success,
'dado' => $dado

 ));

}


// CONSULTAR CPF VIA NAVEGADOR

//http://localhost/marcio_rodrigo/aula_php/dashboard/ordens/consultar_cpf.php?cpf=789.123.456-00 CONSULTAR O CPF NO NAVEGADOR
//http://localhost/marcio_rodrigo/dashboard/ordens/consultar_cpf.php?cpf=789.123.456-00