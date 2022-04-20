<?php

session_start();

require "include/db.php";

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
if( empty( $_SESSION["user"] ) ){

include "include/menu.php";

?> <div class="container-fluid">

<div class="row">

    <div class="col-12 col-md-8 offset-md-2 py-5">
        <h1 class="pb-4">Vous devez être connecté</h1>
        <p class="alert alert-warning">Veuillez <a href="login.php">cliquer ici</a> pour vous connecter d'abord !</p>
    </div>

</div>

</div>
<?php

}
if( isset( $_SESSION["user"] ) ){

include "include/menu-user.php";

?>

<div class="container-fluid">

    <div class="row">

        <div class="col-12 col-md-8 offset-md-2 py-5">

            <h1 class="pb-4 text-center">Mon Profil</h1>

            <div class="row">

                <div class="col-md-6 col-12 offset-md-3 my-4">

                    <ul class="list-group">
                        <li class="list-group-item"><strong>Email</strong> : <?php echo htmlspecialchars($_SESSION["user"]["email"]) ?> </li>
                        <li class="list-group-item"><strong>Pseudo</strong> : <?php echo htmlspecialchars($_SESSION["user"]["pseudonym"]) ?> </li>
                        <li class="list-group-item"><strong>Date d'inscription</strong> : <?php echo htmlspecialchars($_SESSION["user"]["register_date"]) ?> </li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>
<?php
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>