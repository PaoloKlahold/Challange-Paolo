<?php
session_start();
$host = "pgsql_desafio";
$db = "applicationphp";
$user = "root";
$pw = "root";

try {
  
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $myPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }   catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados. <br/>";
    die($e->getMessage());
  }


?>