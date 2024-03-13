<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost:5173');

$categoriass = array();
$host = "pgsql_desafio";
$db = "applicationphp";
$user = "root";
$pw = "root";
try {
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);     
}   catch (PDOException $e) {
    echo 'Não conectou';
}
  $sql = "SELECT code, categoriesname FROM public.categories";
  try {
    $stmt = $myPDO->prepare($sql);
    if ($stmt->execute()) {
      $categoriass = $stmt->fetchAll();
    }
    else {
      die("Falha ao executar a SQL.. #2");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }

echo json_encode($categoriass);


die();


?>

