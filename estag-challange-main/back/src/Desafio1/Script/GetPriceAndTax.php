<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Max-Age: 86400');


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


if (!empty($_GET)) {
        try {
            $SelectProducts = $_GET['code'];

            $stmt = $myPDO->prepare("SELECT pp.price, pc.tax FROM public.products as pp, public.categories as pc WHERE pp.code = $SelectProducts AND pp.category_code = pc.code");
            if ( $stmt->execute()) {
                $itens = $stmt->fetchAll();
                echo json_encode($itens);
            } else {
                echo ("Consulta realizada com Fracasso!");
                
            }
        } catch (PDOException $e) {
            echo ("Falha ao cadastrar");
            
        };

    
}  else {
    echo ("Post vazio");
    
}


die();


?>