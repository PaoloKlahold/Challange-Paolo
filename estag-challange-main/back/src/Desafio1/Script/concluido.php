<?php 
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost:5173');


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

$Actualuser = $_GET['code'];

$sql4 = "SELECT pp.code, ph.htotal, ph.price, ph.hamount, pc.tax FROM public.home as ph, public.products as pp, public.categories as pc WHERE pp.code = ph.product_code AND pp.category_code = pc.code";
try {
    $stmt = $myPDO->prepare($sql4);
    if ($stmt->execute()) {
    $HomeCompras = $stmt->fetchAll();
    }
    else {
    die("Falha ao executar a SQL.. #2");
    }
} catch (PDOException $e) {
    die($e->getMessage());
}

    if (!empty($HomeCompras)) {
        $TaxT = 0;
        $TotalT = 0;
        foreach ($HomeCompras as $h) {
            $TaxT = ($TaxT + (($h['price'] * $h['hamount']) * ($h['tax'] / 100)));
            $TotalT = ($TotalT + $h['htotal']);
        }
        
        
        $sqladdHistory = $myPDO->prepare("INSERT INTO public.HISTORY (Total, Tax, Huseremail) VALUES ($TotalT, $TaxT, '$Actualuser');");
            if ($sqladdHistory->execute()) {
            } else {
                header("erro insert em hist");
            }

        $HistoryCodeActualarray = array();
        $GetHistoryCode = "SELECT his.code FROM public.history as his ORDER BY code DESC LIMIT 1;";
        try {
            $stmt = $myPDO->prepare($GetHistoryCode);
            if ($stmt->execute()) {
            $HistoryCodeActualarray = $stmt->fetchAll();
            }
            else {
            die("Falha ao executar a SQL.. #2");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        foreach ($HomeCompras as $h) {
            foreach ($HistoryCodeActualarray as $hh){
            $HistoryCodeActual = $hh['code'];}
            $DetailsProductCode = $h['code'];
            $DetailsAmount = $h['hamount'];
            $DetailsPrice = $h['price'];
            $Detailstax = $h['tax'];

            $sqladdDetails = $myPDO->prepare("INSERT INTO public.details 
                (HISTORY_CODE, PRODUCT_CODE, AMOUNT, PRICE, TAX) 
            VALUES 
                ($HistoryCodeActual, $DetailsProductCode, $DetailsAmount, $DetailsPrice, $Detailstax);");
            if ($sqladdDetails->execute()) {
            } else {
                header("Erro ao insert em details");
            }
        }

    $sqlDELETEHOME = "DELETE FROM public.home;";
    try {
    $stmt = $myPDO->prepare($sqlDELETEHOME);
    if ($stmt->execute()) {
    }
    else {
    die("Falha ao executar a SQL.. #2");
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
    } else{
        echo("Nada no carrinho");;
    }
?>