<?php
session_start();
$_SESSION['Acess'] = true;
$_SESSION['ActualUser'] = '';
?>
<script>
        window.location.href = "../cadastro.php";  

</script>