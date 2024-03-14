<?php

header('Access-Control-Allow-Origin: http://localhost:5173');
header('Content-Type: application/json; charset=utf-8');

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
        $Email = $_POST['Email'];
        $password = htmlentities($_POST['password']);


        $sql = "SELECT pu.useremail FROM public.users as pu WHERE pu.useremail = '$Email' AND pu.userpassword = '$password'";
        try {
          $stmt = $myPDO->prepare($sql);
          if ($stmt->execute()) {
            $loginn = $stmt->fetchAll();
            echo json_encode($loginn);
          }
          else {
            echo("Falha ao executar a SQL.. #2");
          }
        } catch (PDOException $e) {
          die($e->getMessage());
        }

    } catch (PDOException $e) {
        echo ("Falha ao cadastrar");
        
    };

    
}  else {
    echo ("Post vazio");
    
}


die();


?>