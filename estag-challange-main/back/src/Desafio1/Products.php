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
    <link rel="stylesheet" href="Style\Products.css">
    <link rel="stylesheet" href="Style\Buttons.css">
    <link rel="stylesheet" href="Style\Header.css">
    <link rel="stylesheet" href="Style\Functions.css">
    <link rel="stylesheet" href="Style\Table.css">
    <!--<script src="Script\products.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Products</title>
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
        <form id="collumn1" method="post" action="Script/ProcessaProducts.php">
            <h1 id="Product">Products</h1>
            <div id="test">
            <div id="subCollumns1">
            
            <div class="input-control-ProductNameInput">
                <input class="form-control" onchange="validateOnlyProductName()" name="ProductNameInput" placeholder="Product Name" id="ProductNameInput" type="text" >
                <div class="error"></div>
            </div>
            </div>
            </div>
            <div id="test">
                <div id="subCollumns1">
                    <div class="input-control">
                    <input class="form-control" onchange="validateOnlyAmount()" name="AmontInput" value="" placeholder="Amount" id="AmontInput" type="number">
                    <div class="error"></div>
                    </div>

                    <?php
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
                    $sql = "SELECT pc.code, pc.categoriesname FROM public.categories as pc";
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

                    ?>
                    <div class="DivdropdownlistCategory" id="DivdropdownlistCategory">
                        <select name="dropdownlistCategory" onchange="validateOnlydroptable()" placeholder="Products" class="dropdownlistCategory" id="dropdownlistCategory">
                           <option disabled selected value='Default' >Categories</option>
                           <?php if (!empty($categorias)) { 
                                foreach ($categorias as $a) { ?>
                                <option value='<?php echo $a['code']; ?>' name='<?php echo $a['code']; ?>'><?php echo $a['categoriesname']; ?></option>
                                <?php } ?>
                                <?php } ?>
                        </select>
                        <div style="    color: red;
                        font-size: 1.4cap;
                        height: 13px;" class="error"></div>
                   </div>
        
                    <div class="input-control">
                    <input onchange="validateOnlyUnit()" name="UnitInput" value="" placeholder="Unit Price" id="UnitInput" type="number" > 
                    <div class="error"></div> 
                    </div>
                </div>
            </div>
            <div id="test">
                <div id="subCollumns1">
                    
                </div>
            </div>
                 <div id="DivButtonAddProduct"><button type="submit" id="ButtonAddProduct"> Add Product </button></div>
                
        </form>
<?php
$products = array();
$host = "pgsql_desafio";
$db = "applicationphp";
$user = "root";
$pw = "root";
try {
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);     
}   catch (PDOException $e) {
    echo 'Não conectou';
}


$sql2 = "SELECT pp.code, pp.productsname, pp.price, pp.amount, pc.categoriesname FROM public.products as pp, public.categories as pc WHERE pp.category_code = pc.code";
try {
    $stmt = $myPDO->prepare($sql2);
    if ($stmt->execute()) {
    $products = $stmt->fetchAll();
    }
    else {
    die("Falha ao executar a SQL.. #2");
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
?>

        <div id="collumn2">
            <div id="DivSuitStoreTable">
                <table id="SuitStoreTable">
                    <tr id="SuitStoreTableTR"><th>Code</th><th id="nameProductTH">Product</th><th>Amount</th><th>Unit price</th><th id="ThNoRightBorder">Category</th></tr>
                    <?php if (!empty($products)) { 
                    foreach ($products as $p) { ?>
                    <tr>
                    <td><?php echo $p['code']; ?></td>
                    <td><?php echo $p['productsname']; ?></td>
                    <td><?php echo $p['amount']; ?></td>
                    <td>$<?php echo $p['price']; ?></td>
                    <td id="ThNoRightBorder"><?php echo $p['categoriesname'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <!--<tr><td>1</td><td>Rice</td><td>10</td><td>$20.00</td><td id="ThNoRightBorder">Food</td><td id="RemoveItem"><button>Delete</button></td></tr>
                    <tr><td>2</td><td>Beans</td><td>1</td><td>$9.00</td><td id="ThNoRightBorder">Food</td><td id="RemoveItem"><button>Delete</button></td></tr> -->
                    <tr id="space"><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonAndRightBorder" id="ThNoBottonBorder"></td></tr> 
                </table>
            </div>
        </div>
    </div>
</body>
<script src="Script\validationp2.js"></script>
<script> 

</script>
</html>