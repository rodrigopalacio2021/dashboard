<?php
//COMANDO "TRY" CONEXÃO COM O BANCO DE DADOS

define('username', 'root');
define('password', '');

try {
    $conn = new PDO(

        'mysql:host=localhost;dbname=ordem_servico',
        username,
        password


    );    // variável de conexão com o banco de dados variável "$conn". 

} catch (PDOException $e) {
    echo "Error:". $e->getMessage();
    exit;
}


//VAR_DUMP IRÁ PRINTAR UMA ARRAY