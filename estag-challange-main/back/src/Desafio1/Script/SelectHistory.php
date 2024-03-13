<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost:5173');

$categorias = array();
$host = "pgsql_desafio";
$db = "applicationphp";
$user = "root";
$pw = "root";
try {
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);     
}   catch (PDOException $e) {
    echo 'Não conectou';
}
  $sql = "SELECT * FROM public.history";
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

echo json_encode($products);


die();


?>

