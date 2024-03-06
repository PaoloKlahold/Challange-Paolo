<?php
require_once 'conectaBD.php';
require_once 'User.php';


if (!empty($_POST)) {
    if($_POST['NameInput'] == '' || empty($_POST['NameInput'])){
        header("Location: ../cadastro.php?msgErro=nomeembranco...");
    } else if(strlen($_POST['password']) < 8 || empty($_POST['password'])){
        header("Location: ../cadastro.php?msgErro=senhapequena...");
    } else if (empty($_POST['birday'])) {
        header("Location: ../cadastro.php?msgErro=semaniversário...");
    } else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !empty($_POST['email'])) {
        if (searchEmail($_POST['email']) == false) {
        setUser(htmlentities($_POST['email']), htmlentities($_POST['NameInput']), htmlentities($_POST['password']), $_POST['birday']);
        
        header("Location: ../home.php?");
        } else {
            header("Location: ../cadastro.php?emailrepetido...");
        }
    } else {
        header("Location: ../cadastro.php?msgemailinvalido...");
    }
} else {
    header("Location: ../cadastro.php?tabugado...");
}

?>