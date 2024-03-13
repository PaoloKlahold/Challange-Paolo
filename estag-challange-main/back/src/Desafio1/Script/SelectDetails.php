<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Max-Age: 86400');

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

if (!empty($_POST)) {
 $historyCode = $_POST['code'];
  $sql = "SELECT pp.productsname, pd.amount, pd.price, pd.tax, trunc((pd.price * pd.amount) + (pd.price * pd.amount) * (pd.tax / 100), 2) as total FROM public.Details as pd, public.products as pp WHERE pd.history_code = $historyCode AND pp.code = pd.product_code";
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

} else{
    echo('postvazio');
}

die();


?>

