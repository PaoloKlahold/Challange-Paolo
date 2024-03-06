<?php
session_start();
$_SESSION['ActualUser'] = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style\Buttons.css">
    <link rel="stylesheet" href="Style\Header.css">
    <link rel="stylesheet" href="Style\Functions.css">
    <link rel="stylesheet" href="Style\Table.css">
    <link rel="stylesheet" href="Style\Validation.css">
    <link rel="stylesheet" href="Style\Register.css">
    <link rel="stylesheet" href="https://unpkg.com/balloon-css/balloon.min.css">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <title>Login</title>
</head>
<body>
    <div id="Cabecalho1">
        <h1 id="RemoveUnderline" id="Suite">Suite Store</h1>
        
    </div>
    <br>
        
    <div class="page">

        <form class="form-retangle" method="post" action="Script\processlogin.php">
            <h1 id="Register">Login</h1>
            <?php if ($_SESSION['Acess'] == false) {echo "<a style='font-size: 1.4cap; color: red; margin-bottom: 1cap'>Please register or login before going to another page</a>";}  ?>
            
            <br>
            <div class="input-control">
                    <input onchange="validateOnlyemail()"  id="email" name="email" type="email" placeholder="yourmail@email.com">
                <div class="error"></div>
            </div>

            <div class="input-control">
                    <input onchange="validateOnlypassword()"  id="password" name="password" type="password" placeholder="password">
                <div class="error"></div>
            </div>
            <div id="SenhaOuEmail" class="SenhaOuEmail">wrong login or password</div>

            <br>

            <div style="display: flex;align-content: center;align-items: center;">
                <button type="submit" onclick="register()" class="RegisterAndLogin" style="margin-right: 2cap">Login</button>
                <!-- <button onclick="login()" class="RegisterAndLogin">Login</button> -->
            </div>
        
            <br>
            <div aria-label="Disabled" data-balloon-pos="right" class='g-sign-in-button'>
                <div class=content-wrapper>
                    <div class='logo-wrapper'>
                        <img src='https://developers.google.com/identity/images/g-logo.png'>
                    </div>
                    <span class='text-container'>
                <span>Sign in with Google</span>
                </span>
                </div>
            </div>
            <br>
            <a style="color: blue" href="cadastro.php">Register ↗</a>
        </form>

</body>
<script src="Script\validationRegister.js"></script>
<script>
    if (window.location.href == 'http://localhost/Desafio1/cadastro.php?emailrepetido...'){
        alert('email repetido')
    }
    if (window.location.href == 'http://localhost/Desafio1/login.php?EmailouSenhaInvalidos...' || window.location.href == 'http://localhost/Desafio1/login.php?SenhaouEmailInvalidos...'){
        const SenhaOuEmail = document.getElementById('SenhaOuEmail');
        SenhaOuEmail.classList.add('error');
    }

</script>

</html>