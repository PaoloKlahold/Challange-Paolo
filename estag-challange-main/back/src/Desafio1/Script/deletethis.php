<?php

header('Access-Control-Allow-Origin: http://localhost:5173');

$host = "pgsql_desafio";
$db = "applicationphp";
$user = "root";
$pw = "root";

try {
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);
    $myPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}   catch (PDOException $e) {
    
    die($e->getMessage());
}


if (!empty($_POST)) {

    try {

        $homeidd = $_POST['delete'];
        

        $statement = $myPDO->prepare("DELETE FROM public.Home as ph WHERE ph.homeid = $homeidd");
        if ( $statement->execute()) {
            echo ("cadastrou!\n");
            
        
        } else {
            echo ("Cadastro realizado com Fracasso!");
            
        }
    } catch (PDOException $e) {
        echo ("Falha ao cadastrar");
        
    };


    
}  else {
    echo ("Post vazio");
    
}


die();


?>