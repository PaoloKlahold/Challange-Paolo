<?php 
    $HomeCompras = array();
    $host = "pgsql_desafio";
    $db = "applicationphp";
    $user = "root";
    $pw = "root";
    try {
        $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);     
    }   catch (PDOException $e) {
        echo 'Não conectou';
    }

    $sqlDELETEHOME = "DELETE FROM public.home;";
    try {
    $stmt = $myPDO->prepare($sqlDELETEHOME);
    if ($stmt->execute()) {
        header("Location: ../Home.php?msgDeletado...");
    }
    else {
    die("Falha ao executar a SQL.. #2");
    }
} catch (PDOException $e) {
    die($e->getMessage());
}?>
                    
