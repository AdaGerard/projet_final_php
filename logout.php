<?php

session_start();

require "include/db.php";

// faire l'appel des variables super globales de session
if(
    isset($_SESSION["user"])
){

    // Suppression en session du tableau user (et deconnexion)
    unset($_SESSION["user"]);

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Accueil de Wikifruit</title>
</head>
<body>

<!-- Menu -->
<?php
include "include/menu.php";
?>
<div class="container-fluid">

    <div class="row">

        <div class="col-12 col-md-8 offset-md-2 py-5">
            <h1 class="pb-4">Vous devez être connecté</h1>
            <p class="alert alert-warning">Veuillez <a href="login.php">cliquer ici</a> pour vous connecter d'abord !</p>
        </div>

    </div>

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>