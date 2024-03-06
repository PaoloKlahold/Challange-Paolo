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
    <link rel="stylesheet" href="Style\Categories.css">
    <link rel="stylesheet" href="Style\Buttons.css">
    <link rel="stylesheet" href="Style\Header.css">
    <link rel="stylesheet" href="Style\Functions.css">
    <link rel="stylesheet" href="Style\Table.css">
    <script src="Script\validations.js"></script> 
    <!--<script src="Script\categories.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Categories</title>
</head>
<body>
</script>
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
        <form id="collumn1" method="post" action="Script/ProcessaCategorias.php">
            <h1 id="Categories">Categories</h1>
            <div id="test">
                <div id="subCollumns1">
                    <div id="CategoryName-input-control" class="input-control">
                        <input value='' id="CategoryName" name="CategoryName" onchange="validateOnlyName()" placeholder="Category name" type="text" class="form-control">
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div id="test">
                <div id="subCollumns1">
                    <div class="input-control">
                        <input placeholder="Tax Value" onchange="validateOnlyTax()" id="CategoryTax" type="number" class="form-control" name="CategoryTax">
                        <div class="error"></div>
                    </div>
                </div>
            </div>
             
            
            <div id="DivButtonAddProduct"><button onclick="validateInputs()" value="Submit" type="submit" id="ButtonAddProduct">Add Category</button></div>
            <!-- onclick="getCategoriesItens() -->
            
        </form>
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
  $sql = "SELECT * FROM public.categories";
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
        <div id="collumn2">
            <div id="DivSuitStoreTable">
                <table id="SuitStoreTable">
                    <tr id="SuitStoreTableTR"><th>Code</th><th id="nameProductTH">Category</th><th id="ThNoRightBorder">Tax</th></tr>
                    <?php if (!empty($categorias)) { 
                    foreach ($categorias as $a) { ?>
                    <tr>
                    <td><?php echo $a['code']; ?></td>
                    <td><?php echo $a['categoriesname']; ?></td>
                    <td id="ThNoRightBorder"><?php echo $a['tax']; ?>%</td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <tr id="space"><td id="ThNoBottonBorder"></td></td><td id="ThNoBottonBorder"></td><td id="ThNoBottonAndRightBorder" id="ThNoBottonBorder"></td></tr> 
                </table>
            </div>
        </div>
    </div>
</body>
</html>
