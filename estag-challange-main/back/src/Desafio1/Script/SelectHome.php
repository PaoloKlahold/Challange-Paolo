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
  $sql = "SELECT ph.homeid, ph.price, ph.hamount, ph.htotal, pp.productsname, pc.tax FROM public.home as ph, public.products as pp, public.categories as pc WHERE pp.code = ph.product_code AND pp.category_code = pc.code";
  try {
    $stmt = $myPDO->prepare($sql);
    if ($stmt->execute()) {
      $products = $stmt->fetchAll();
    }
    else {
      die("Falha ao executar a SQL.. #2");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }

echo json_encode($products);


die();


?>

