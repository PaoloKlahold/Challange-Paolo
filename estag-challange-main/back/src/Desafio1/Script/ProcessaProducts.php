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

print_r($_POST);

if (!empty($_POST)) {
    
        try {
            $name = htmlentities($_POST['productName']);
            $price = htmlentities($_POST['productPrice']);
            $amount = htmlentities($_POST['productAmount']);
            $categorie = $_POST["SelectProducts"];

            $statement = $myPDO->prepare("INSERT INTO public.products 
                                        (productsname, price, amount, category_code) 
                                        VALUES 
                                        ('$name', $price, $amount, $categorie );");
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