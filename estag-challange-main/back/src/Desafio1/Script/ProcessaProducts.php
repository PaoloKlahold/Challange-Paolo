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

    if($_POST['ProductNameInput'] == '' || $_POST['ProductNameInput'] == null){
        header("Location: ../Products.php?msgErro=NomeIncompativel...");
    } else if($_POST['AmontInput'] <= 0){
        header("Location: ../Products.php?msgErro=AmountNegativo...");
    } else if(empty($_POST['dropdownlistCategory'])){
        header("Location: ../Products.php?msgErro=CategoriaPadrao...");
    } else if($_POST['UnitInput'] < 0){
        header("Location: ../Products.php?msgErro=PriceNegativo...");
    } else if ($_POST['UnitInput'] >= 0 || $_POST['AmontInput'] > 0){
        try {
            $name = htmlentities($_POST['ProductNameInput']);
            $amount = $_POST['AmontInput'];
            $dropdownlistCategory = $_POST['dropdownlistCategory'];
            $UnitInput = $_POST['UnitInput'];

            $statement = $myPDO->prepare("INSERT INTO public.products (productsname, price, amount, category_code) VALUES ('$name', $UnitInput, $amount, $dropdownlistCategory);");
            if ( $statement->execute()) {
             header("Location: ../Products.php?msgSucesso=Cadastro realizado com sucesso!");
            } else {
                header("Location: ../Products.php?msgSucesso=Fracasso!");
            }
        } catch (PDOException $e) {
            header("Location: ../Products.php?msgErro=Falha ao cadastrar...");
        }
    } else {
        header("Location: ../Products.php?msgErro=NaoNumero...");
    }

    
}  else {
    header("Location: ../Products.php?msgErro=Erro de acesso.");
}


die();

?>