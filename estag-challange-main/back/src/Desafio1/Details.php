<?php
session_start();
?>
<script>
    
    if('<?php echo $_SESSION['ActualUser'] ?>' == ''){
        <?php 
            if ($_SESSION['ActualUser'] == '') {
                $_SESSION['Acess'] = false;
            } else{
                $_SESSION['Acess'] = true;
            }
        ?> 
        window.location.href = "http://localhost/Desafio1/Cadastro.php";
    }
        
    
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style\Details.css">
    <link rel="stylesheet" href="Style\Buttons.css">
    <link rel="stylesheet" href="Style\Header.css">
    <link rel="stylesheet" href="Style\Functions.css">
    <link rel="stylesheet" href="Style\Table.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Deatails</title>
</head>
<body>
<div id="Cabecalho1">
        <div class="Part1">
        <h1 id="RemoveUnderline" onclick="window.location.href = 'Home.php'" href="Home.php" id="Suite">Suite Store</h1>
        <h2 id="RemoveUnderline" onclick="window.location.href = 'Products.php'" href="Products.php">Products</h2>
        <h2 id="RemoveUnderline" onclick="window.location.href = 'Categories.php'" href="Categories.htphpml">Categories</h2>
        <h2 id="RemoveUnderline" onclick="window.location.href = 'History.php'" href="History.php">History</h2>
        </div>
        <div class="Part2">
            <div class="dropdown">
                <div class="help">
                    <img class="genericprofile" src="Style\profile.png">
                </div>
                <div class="dropdown-content">
                    <h1 href="#"><?php echo $_SESSION['ActualUser']?></h1>
                    <a href="Script/logout.php">log out ↗</a>
                    
                </div>
            </div>
        </div>
    </div>

    <br>
    <div id="collumns">
    
        <div id="collumn1">
            <h1 id="Detais">Details</h1>
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
        $DetailsTable = array();
        $HistoryCodeHere = $_POST['ButtonDeleteItem'];
        $DetailsTablesql = "SELECT pc.productsname, pd.amount, pd.price, pd.tax FROM public.Details as pd, public.products as pc WHERE pc.code = pd.product_code AND pd.history_code = $HistoryCodeHere";
        try {
            $stmt = $myPDO->prepare($DetailsTablesql);
            if ($stmt->execute()) {
            $DetailsTable = $stmt->fetchAll();
            }
            else {
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        } 
    }
?>
            <table id="SuitStoreTable">
                <tr><th>Name</th><th>Amount</th><th>Price</th><th>Tax</th><th id="ThNoRightBorder">TOTAL (Tax + Price)*Amount</th></tr>
                <?php if (!empty($DetailsTable)) { 
                    foreach ($DetailsTable as $dt) { ?>
                    <tr>
                    <td><?php echo $dt['productsname']; ?></td>
                    <td><?php echo $dt['amount']; ?></td>
                    <td>$<?php echo $dt['price']; ?></td>
                    <td><?php echo $dt['tax']; ?>%</td>
                    <td id='ThNoRightBorder'>$<?php echo ( ((($dt['tax'] / 100) * $dt['price']) + $dt['price']) * $dt['amount'] );?></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
            <!--    <tr><td>Rice</td><td style="color: green;">Concluded</td><td>2</td><td>$20.00</td><td>2022/02/02</td></tr>-->
                <tr id="space"><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonAndRightBorder" ></td></tr>
            </table>
        </div>
        <div id="collumn2"></div>
    </div>
</body>
</html>