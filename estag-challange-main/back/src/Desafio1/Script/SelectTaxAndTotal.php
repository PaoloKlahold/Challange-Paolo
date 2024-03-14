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
  $sql = "SELECT trunc(sum(((pc.tax / 100) * (pp.price * ph.hamount))), 2) as sumtax, sum(ph.htotal) as sumtotal 
                FROM public.categories as pc, public.home as ph, public.products as pp 
                WHERE ph.product_code = pp.code AND pp.category_code = pc.code";
  try {
    $stmt = $myPDO->prepare($sql);
    if ($stmt->execute()) {
      $categorias = $stmt->fetchAll();
    }
    else {
      die("Falha ao executar a SQL.. #2");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
echo json_encode($categorias);


die();


?>

