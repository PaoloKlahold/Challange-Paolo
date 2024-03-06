<?php
session_start();
require_once 'User.php';


if (!empty($_POST)) {
    if($_POST['password'] == '' || empty($_POST['password'])){
        header("Location: ../login.php?msgErro=nomeembranco...");
    } else if ($_POST['email'] == '' || empty($_POST['email'])){
        header("Location: ../login.php?emailembranco...");
    } else if (searchEmail($_POST['email']) == false) {
        header("Location: ../login.php?EmailouSenhaInvalidos...");
    } else {
        if (passwordcheck($_POST['email'], $_POST['password']) == true || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['ActualUser'] = $_POST['email'];
            header("Location: ../home.php?");
        } else {
            header("Location: ../login.php?SenhaouEmailInvalidos...");
        }
    }
}


?>