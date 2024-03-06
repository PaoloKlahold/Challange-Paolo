<?php
$host = "pgsql_desafio";
$db = "applicationphp";
$user = "root";
$pw = "root";
    try {
        $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $myPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }   catch (PDOException $e) {

        echo "Falha ao conectar ao banco de dados. <br/>";
        die($e->getMessage());
    }

function getuserIdByEmail($actuaemail) {
    $array = array();
    $sql = "SELECT u.userid FROM public.users as u WHERE u.useremail = '$actuaemail'";
    global $myPDO;
    try {
        $stmt = $myPDO->prepare($sql);
        if ($stmt->execute()) {
        $array = $stmt->fetchAll();
        }
        else {
        die("Falha ao executar a SQL.. #2");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($array as $a) {
        $thisid = intval($a['userid']);
    }
    return $thisid;
}

function tryselect($sql){
        global $myPDO;
        $array = array();
        try {
            $stmt = $myPDO->prepare($sql);
            if ($stmt->execute()) {
            $array = $stmt->fetchAll();
            }
            else {
            die("Falha ao executar a SQL.. #2");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    
        return $array;
    }
function setUser($UserEmail, $UserName, $UserPassword, $UserBird){
    global $myPDO;

    $statement = $myPDO->prepare("INSERT INTO public.users (useremail, username, userpassword, userbird) VALUES ('$UserEmail', '$UserName', '$UserPassword', '$UserBird');");
    $statement->execute();
    $_SESSION['ActualUser'] = $UserEmail;

}

function searchEmail($email){
    global $myPDO;
    $sql = "SELECT u.Useremail FROM public.Users as u WHERE u.Useremail = '$email'";
    $emails = tryselect($sql);
    if (!empty($emails)) {
        return true;
    } else {
        return false;
    }
    
}



function passwordcheck($email, $UserPassword){
    global $myPDO;
    $sql = "SELECT * FROM public.users as u WHERE u.useremail = '$email' AND u.userpassword = '$UserPassword'";
    $count = tryselect($sql);
    if (!empty($count)) {
        return true;
    } else {
        return false;
    }
}