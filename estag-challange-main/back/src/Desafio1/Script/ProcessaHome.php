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
    
    if(empty($_POST['dropdownlistProduct'])){
        header("Location: ../Home.php?msgErro=opcaonaoescolhida...");
    } else if($_POST['AmontInput'] <= 0){
        header("Location: ../Home.php?msgErro=AmountNegativo...");
    } else if ($_POST['AmontInput'] > 0){
        try {
            $values = array();
            $code = htmlentities($_POST['dropdownlistProduct']);
            $amount = $_POST['AmontInput'];

            $sql3 = "SELECT pp.code, pp.price, pc.tax FROM public.products as pp, public.categories as pc WHERE pp.category_code = pc.code";
            try {
                $stmt = $myPDO->prepare($sql3);
                if ($stmt->execute()) {
                $values = $stmt->fetchAll();
                }
                else {
                die("Falha ao executar a SQL.. #2");
                }
            } catch (PDOException $e) {
                die($e->getMessage());
            }
            foreach ($values as $v) {
                if ($v['code'] == $code) {
                    $price = $v['price'];
                    $tax = $v['tax'];
                }
            }
            $total = ($price * $amount);
            
            $statement = $myPDO->prepare("INSERT INTO public.HOME (PRODUCT_CODE, PRICE, HAMOUNT, HTOTAL) VALUES ($code, $price, $amount, $total);");
            
            if ( $statement->execute()) {
             header("Location: ../Home.php?msgSucesso=Cadastro realizado com sucesso!");
            } else {
                header("Location: ../Home.php?msgSucesso=Fracasso!");
            }
        } catch (PDOException $e) {
            header("Location: ../Home.php?msgErro=Falha ao cadastrar...");
        };
        } else {
            header("Location: ../Home.php?msgErro=AmountNaoNumero...");
    }

    
}  else {
    header("Location: ../Categories.php?msgErro=Erro de acesso.");
}


die();

?>