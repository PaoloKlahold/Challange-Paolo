<?php
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
        $homeidd = $_POST['trash'];
        $homerowsql = "DELETE FROM public.Home as ph WHERE ph.homeid = $homeidd";
        try {
            $stmt = $myPDO->prepare($homerowsql);
            if ($stmt->execute()) {
                header("Location: ../Home.php?msgRowDeletado...");
            }
            else {
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        } 
    }
?>