<?php

require 'utilisateurs.php';
require 'tache.php';
$route = isset($_REQUEST["route"])? $_REQUEST["route"] : "home";

switch($route) {
    case "home" : $view = showHome();
        break;
    case "insert_user" : insertUser();
        break;
    default : showHome();
}

function showHome(): string {

    return "home.html";
}

function insertUser() {
   
$user = new Utilisateurs();
$user = setPseudo($pseudo);
$user = setPassword($password);
$user->save_user();
header('Location:index.php');

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