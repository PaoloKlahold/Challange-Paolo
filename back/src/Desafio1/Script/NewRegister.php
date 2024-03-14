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
        $name = htmlentities($_POST['FullName']);
        $Email = $_POST['Email'];
        $password = htmlentities($_POST['password']);
        

        $sql = "SELECT * FROM public.users as pu WHERE pu.useremail = '$Email'";
        try {
          $stmt = $myPDO->prepare($sql);
          if ($stmt->execute()) {
            $products = $stmt->fetchAll();
          }
          else {
            die("Falha ao executar a SQL");
          }
        } catch (PDOException $e) {
          die($e->getMessage());
        }



        if (empty($products) || $products == '') {
            $statement = $myPDO->prepare("INSERT INTO public.users (username, useremail, userpassword) VALUES ('$name', '$Email', '$password');");
            if ( $statement->execute()) {
                
                
            } else {
                echo ("Cadastro realizado com Fracasso!");
                
            }
        } else {
            echo ("this email address has already been registered");
        }
    } catch (PDOException $e) {
        echo ("Falha ao cadastrar");
        
    };

    
}  else {
    echo ("Post vazio");
    
}


die();


?>