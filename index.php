<?php

require "conf/global.php";

spl_autoload_register(function ($class) {
    if(file_exists("models/$class.php")){
        require_once "models/$class.php";
    }
});

$route = isset($_REQUEST["route"])? $_REQUEST["route"] : "home";

switch($route) {
    case "home" : $view = showHome();
        break;
    case "insert_user" : insertUser();
        break;
    case "connect_user" : connectUser();
        break;
    case "insert_tache" : insertTache();
        break;
    case "deconnect" : deconnectUser();
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

    function deconnectUser() {
    unset($_SESSION['pseudo']);
    header('Location:index.php');
        }

    function insertTache() {
         if(!empty($_POST['description'] && !empty($_POST['date']))){
            $user = new Tache();
            $user-> setDescription($_POST['description']);
            $user-> setDate($_POST['date']);
            $user->save_tache();
            header('Location:index.php');
            }
    }

    function showMembre() {

    $user = new Utilisateurs();
    $user->selectAll();
    
    return "membre.php";
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

    <?php require "$view"?>
    
</body>
</html> 