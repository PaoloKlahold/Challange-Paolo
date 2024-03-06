<?php 
require_once 'User.php';
session_start();
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
            $TaxT = ($TaxT + ($h['htotal'] * ($h['tax'] / 100)));
            $TotalT = ($TotalT + $h['htotal']);
        }
        
        $thisid = getuserIdByEmail($_SESSION['ActualUser']);
        $sqladdHistory = $myPDO->prepare("INSERT INTO public.HISTORY (Total, Tax, huserid) VALUES ($TotalT, $TaxT, $thisid);");
            if ($sqladdHistory->execute()) {
            } else {
                header("Location: ../Home.php?ErroHistorico!");
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
                header("Location: ../Home.php?msgSucesso=Fracasso!");
            }
        }

    $sqlDELETEHOME = "DELETE FROM public.home;";
    try {
    $stmt = $myPDO->prepare($sqlDELETEHOME);
    if ($stmt->execute()) {
        header("Location: ../History.php?TudoRealizadoELimpo...");
    }
    else {
    die("Falha ao executar a SQL.. #2");
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
    } else{
        header("Location: ../Home.php?NadaNoCarrinho...");
    }
?>