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

        $name = $_POST['SelectProducts'];
        $tax = $_POST['Tax'];
        $amount = $_POST['Amount'];
        $price = $_POST['Price'];
        $total = $price * $amount + (($price * $amount) * ($tax / 100));

        $statement = $myPDO->prepare("INSERT INTO public.home (product_code, price, hamount, htotal) VALUES ($name, $price, $amount, $total);");
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