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
    <link rel="stylesheet" href="Style\Home.css">
    <link rel="stylesheet" href="Style\Buttons.css">
    <link rel="stylesheet" href="Style\Header.css">
    <link rel="stylesheet" href="Style\Functions.css">
    <link rel="stylesheet" href="Style\Table.css">
    <link rel="stylesheet" href="Style\Validation.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <title>Home</title>
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
        <form id="collumn1" method="post" action="Script/ProcessaHome.php" >
            <h1 id="Home">Home</h1>
            <div id="test">
                <div id="subCollumns1">
                <a id="MenuItens">Products: </a>
                </div>
            </div>
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
                    $sql = "SELECT pp.code, pp.productsname, pp.price, pc.tax FROM public.products as pp, public.categories as pc WHERE pp.category_code = pc.code";
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
                    }?>
                
            <div  class="DivDropdownlistProduct" id="DivDropdownlistProduct">
                 <select onchange="att()"  name="dropdownlistProduct" placeholder="Products" class="dropdownlistProduct" id="dropdownlistProduct">
                 <option disabled selected value='Default' >Products</option>
                 <?php if (!empty($products)) { 
                                foreach ($products as $p) { ?>
                                <option value='<?php echo $p['code']; ?>' name='<?php echo $p['code']; ?>'><?php echo $p['productsname']; ?></option>
                                <?php } ?>
                                <?php } ?>
                 
                 </select>
                 <div style="    color: red;
                 font-size: 1.4cap;
                 height: 13px;" class="error"></div>
                <!--Vou matar uns pandas aqui embaixo, mas é mais pratico que conectar ao banco de dados pelo js -->
                <?php if (!empty($products)) { 
                    foreach ($products as $p) { ?>
                <input style="display: none;" value='<?php echo $p['tax'];?>%' id='<?php echo $p['code'];?>tax' ></input>
                <input style="display: none;" value='$<?php echo $p['price'];?>' id='<?php echo $p['code'];?>price' ></input>
                <?php } ?>
                <?php } ?>      
            </div>

            <div id="test">
                <div id="subCollumns1">
                    <div class="input-control">
                    <input  onchange="validateOnlyAmount()" name="AmontInput" placeholder="Amount" id="AmontInput" type="number">
                    <div class="error"></div>
                    </div>
                    <div class="input-control">
                    <input value="" placeholder="Tax Value" id="TaxInput" disabled>
                    <div class="error"></div>
                    </div>
                    <div class="input-control">
                    <input value="" placeholder="Unit Price" id="UnitInput" disabled> 
                    <div class="error"></div> 
                    </div>
                </div>
            </div>
            <div id="test">
                <div id="subCollumns1">
                    
                </div>
            </div>
                 <div id="DivButtonAddProduct"><button name="ButtonAddProduct" type="submit" id="ButtonAddProduct"> Add Product </button></div>
                <!-- "-->
        </form>

    <?php
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


        $sql4 = "SELECT ph.homeid, ph.price, ph.hamount, ph.htotal, pp.productsname, pc.tax FROM public.home as ph, public.products as pp, public.categories as pc WHERE pp.code = ph.product_code AND pp.category_code = pc.code";
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


        
    ?>
        <div id="collumn2">
            <div id="DivSuitStoreTable">
                <table id="SuitStoreTable">
                    <tr id="SuitStoreTableTR"><th id="nameProductTH">Product</th><th>Unit price</th><th>Amount</th><th>Total</th><th id="ThNoRightBorder">Del</th></tr>
                    <?php if (!empty($HomeCompras)) { 
                    foreach ($HomeCompras as $h) { ?>
                    <tr>
                    <td><?php echo $h['productsname']; ?></td>
                    <td><?php echo $h['price']; ?></td>
                    <td><?php echo $h['hamount']; ?></td>
                    <td>$<?php echo $h['htotal']; ?></td>
                    <td><form method="POST" action="Script\deletethis.php"><button type="submit" name="trash" id='trash' value='<?php echo $h['homeid'];?>' class='ButtonDeleteItem'>Delete</button></form></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <!--<tr><td>Rice</td><td>$20.00</td><td>2</td><td id="ThNoRightBorder">40.00</td><td id="RemoveItem"><button>Delete</button></td></tr>
                    <tr><td>Beans</td><td>$9.00</td><td>1</td><td id="ThNoRightBorder">9.00</td><td id="RemoveItem"><button>Delete</button></td></tr> -->
                    <tr id="space"><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonAndRightBorder" ></td></tr>
                </table>
            </div>
            
            <div id="fixed">
                <div id="TaxDiv"><a>Tax: </a> <input class="TaxTax" id="TaxFinal" type="text" disabled value="<?php 
                if (!empty($HomeCompras)) { 
                    $TaxT = 0;
                    foreach ($HomeCompras as $h) {
                        $TaxT = ($TaxT + ($h['htotal'] * ($h['tax'] / 100)));
                }
                echo ($TaxT);
                }
                ?>"></div>
                <div id="TaxDiv"><a>Total: </a> <input class="TaxTax" id="TotalFinal" type="text" disabled value="<?php 
                if (!empty($HomeCompras)) { 
                    $TotalT = 0;
                    foreach ($HomeCompras as $h) {
                        $TotalT = ($TotalT + $h['htotal']);
                }
                echo ($TotalT);
                }
                ?>"></div>

                <div id="subCollumns2">

                    <button onclick="window.location.href = 'Script/delete.php'" id="CancelButton">Cancel</button>
                    <!-- deleteall() -->
                    <button onclick="window.location.href = 'Script/concluido.php'" href="Home.php"  id="FinishButton">Finish</button>
                    <!-- finish() -->
                </div>
            </div>
            
        </div>
    </div>
</body>
<script src="Script\validationh.js"></script>
<script src="Script\att.js"></script>
<!-- TEM QUE FAZER O SELECT POR JAVASCRIPT -->
</html>