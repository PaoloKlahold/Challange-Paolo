<?php
require_once 'Script/conectaBD.php';
require_once 'Script/user.php';
?>
<script>
    
    if('<?php 
        if (!empty($_SESSION['ActualUser'])) {echo $_SESSION['ActualUser'];} else {echo '';}
        ?>' == ''){
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
    <link rel="stylesheet" href="Style\History.css">
    <link rel="stylesheet" href="Style\Buttons.css">
    <link rel="stylesheet" href="Style\Header.css">
    <link rel="stylesheet" href="Style\Functions.css">
    <link rel="stylesheet" href="Style\Table.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>History</title>
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
    <?php
        $History = array();
        $host = "pgsql_desafio";
        $db = "applicationphp";
        $user = "root";
        $pw = "root";
        try {
            $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);     
        }   catch (PDOException $e) {
            echo 'Não conectou';
        }
        if (!empty($_SESSION['ActualUser'])){
        $thisid = getuserIdByEmail($_SESSION['ActualUser']);
        $HistoryTable = "SELECT * FROM public.History WHERE huserid = $thisid";
        try {
            $stmt = $myPDO->prepare($HistoryTable);
            if ($stmt->execute()) {
            $History = $stmt->fetchAll();
            }
            else {
            die("Falha ao executar a SQL.. #2");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    } 
    ?>
    <br>
    <h1 id="History">History</h1>
    <div id="collumns">
        <div id="collumn1">
            <table id="SuitStoreTable">
                <tr id="SuitStoreTableTR"><th>Code</th><th>Tax</th><th>Total</th><th>Sum (Total + Tax)</th><th id="ThNoRightBorder">Details</th></tr>
                <?php if (!empty($History)) { 
                    foreach ($History as $h) { ?>
                    <tr>
                    <td><?php echo $h['code']; ?></td>
                    <td>$<?php echo $h['tax']; ?></td>
                    <td>$<?php echo $h['total']; ?></td>
                    <td>$<?php echo ($h['total'] + $h['tax']); ?></td>
                    <td id='ThNoRightBorder'> <form method="POST" action="Details.php"> <button type="submit" name="ButtonDeleteItem"  value="<?php echo $h['code'];?>" id='ButtonDeleteItem'>View</button> </form> </td> 
                    </tr>
                    <?php } ?>
                    <?php } ?>
                
                <!--<tr><td>001</td><td>$2.00</td><td>$20.00</td><td><a id="View" id="RemoveUnderline" onclick="window.location.href = 'Details.html'" href="Detais.html">View</a></td></tr>
                <tr><td>002</td><td>$0.50</td><td>$10.00</td><td><a id="View">View</a></td></tr> -->
                <tr id="space"><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonAndRightBorder" ></td></tr>
            </table>
        </div>
        <div id="collumn2"></div>
        
    </div>
</body>
</html>