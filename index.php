<?php

require 'utilisateurs.php';
require 'tache.php';
$route = isset($_REQUEST["route"])? $_REQUEST["route"] : "home";

switch($route) {
    case "home" : $view = showHome();
        break;
    case "insert_user" : insertUser();
        break;
    case "connect_user" : connectUser();
        break;
    default : showHome();
}

function showHome(): string {

    return "home.html";
}

function insertUser() {
if(!empty($_POST['pseudo'] && !empty($_POST['password']))){
$user = new Utilisateurs();
$user-> setPseudo($_POST['pseudo']);
$user-> setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
$user->save_user();
$pseudo= isset($_POST['pseudo'])? $_POST['pseudo'] : "null";
$password= isset($_POST['password'])? $_POST['password'] : "null";
$_SESSION['pseudo']=$pseudo;
$_SESSION['password']=$password;
}
header('Location:index.php');

}

function connectUser() {
    echo "ok";
    if(!empty($_POST['pseudo'] && !empty($_POST['password']))){
        $user = new Utilisateurs();
        $user-> setPseudo($_POST['pseudo']);
        $user-> setPassword($_POST['password']);
        $user->verify_user();
        }
    }


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma TODO-LIST</title>
</head>
<body>

    <?php require "$view" ?>
    
</body>
</html> 