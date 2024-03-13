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
    
    if($_POST['CategoryName'] == '' || $_POST['CategoryName'] == null){
        
        echo ("Nome vazio");
    } else if($_POST['CategoryTax'] < 0){
        echo ("Tax negativo");
       
    } else if ($_POST['CategoryTax'] >= 0){
        try {
            $name = htmlentities($_POST['CategoryName']);
            $tax = $_POST['CategoryTax'];

            $statement = $myPDO->prepare("INSERT INTO public.categories (categoriesname, tax) VALUES ('$name', $tax);");
            if ( $statement->execute()) {
                echo ("cadastrou!\n");
                
             
            } else {
                echo ("Cadastro realizado com Fracasso!");
                
            }
        } catch (PDOException $e) {
            echo ("Falha ao cadastrar");
            
        };
    } else {
        echo ("TaxNaoNumero");
        
    }

    
}  else {
    echo ("Post vazio");
    
}


die();


?>