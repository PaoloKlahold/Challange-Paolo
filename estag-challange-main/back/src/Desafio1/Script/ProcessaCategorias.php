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
    
    if($_POST['CategoryName'] == '' || $_POST['CategoryName'] == null){
        header("Location: ../Categories.php?msgErro=NomeIncompativel...");
    } else if($_POST['CategoryTax'] < 0){
        header("Location: ../Categories.php?msgErro=TaxNegativo...");
    } else if ($_POST['CategoryTax'] >= 0){
        try {
            $name = htmlentities($_POST['CategoryName']);
            $tax = $_POST['CategoryTax'];

            $statement = $myPDO->prepare("INSERT INTO public.categories (categoriesname, tax) VALUES ('$name', $tax);");
            if ( $statement->execute()) {
             header("Location: ../Categories.php?msgSucesso=Cadastro realizado com sucesso!");
            } else {
                header("Location: ../Categories.php?msgSucesso=Fracasso!");
            }
        } catch (PDOException $e) {
            header("Location: ../Categories.php?msgErro=Falha ao cadastrar...");
        };
    } else {
        header("Location: ../Categories.php?msgErro=TaxNaoNumero...");
    }

    
}  else {
    header("Location: ../Categories.php?msgErro=Erro de acesso.");
}


die();

?>