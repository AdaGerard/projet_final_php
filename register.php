<?php

require "include/recaptchaValid.php";

// Appel des variables
if(
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["confirm-password"]) &&
    isset($_POST["pseudonym"]) &&
    isset($_POST["g-recaptcha-response"])
){
    // Bloc de vérifs
    if( !filter_var( $_POST["email"], FILTER_VALIDATE_EMAIL ) ){

        $errors[] = "Email invalide !";

    }
    // Avec regex : Vérification format mot-de-passe
    if( !preg_match(
        "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !»#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,4096}$/u",
        $_POST["password"] )
    ){

        $errors[] = "Le mot de passe doit comprendre au moins 8 caractères dont 1 lettre minuscule, 1 majuscule, un chiffre et un caractère spécial.";

    }

    if( $_POST["confirm-password"] != $_POST["password"] ){

        $errors[] = "La confirmation ne correspond pas au mot de passe !";

    }
    if( !preg_match(
        "/^[\p{L}\w]{1,50}$/iu",
        $_POST["pseudonym"] )
    ){

        $errors[] = "Le pseudonyme doit contenir entre 1 et 50 caractères";

    }
        //Fonction requiert 2 paramètre : le champ de formulaire concerné & l'adresse IP concernée
    if( !recaptchaValid(
        $_POST["g-recaptcha-response"],
        $_SERVER["REMOTE_ADDR"] )
    ){

        $errors[] = "Veuillez remplir correctement le captcha";

    }

    if ( !isset($errors) ){

        require "include/db.php";

        $insertNewUser = $db->prepare( "INSERT INTO users(email, password, pseudonym, register_date) VALUES(?, ?, ?, NOW())" );

        $querySuccess = $insertNewUser->execute([
            $_POST["email"],
            $_POST["password"],
            $_POST["pseudonym"],
        ]);

        // TODO: Fermer la session de requête :
        $insertNewUser->closeCursor();

        if( $querySuccess ){

            $success = "Votre compte a bien été créé !";

        }else{

            $errors[] = "Problème, veuillez ré-essayer !";

        }

    }

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
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>

<!-- Menu -->
<?php include "include/menu.php";

?>
<div class="container-fluid">

    <div class="row">

        <div class="col-12 col-md-8 offset-md-2 py-5">
            <!-- <p class="text-center"><a class="text-decoration-none" href="register2.php">Voir la version "bonus" avancée de la page d'inscription</a></p> -->
            <h1 class="pb-4 text-center">Créer un compte sur Wikifruit</h1>

            <div class="col-12 col-md-6 mx-auto">
<?php

		// Affichage des erreurs ou du message de succès
		if( isset($errors) ){

			foreach($errors as $error){

				echo "<p class='alert alert-danger mb-3 mt-4'>" . $error . "</p>";

			}

		}

		if( isset($success) ){

			echo "<p class='alert alert-success mb-3 mt-4'> " . $success . " </p>";

		} else {

?>

                    <form action="register.php" method="POST">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input id="email" type="text" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                            <input id="password" type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirmation mot de passe <span class="text-danger">*</span></label>
                            <input id="confirm-password" type="password" name="confirm-password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="pseudonym" class="form-label">Pseudonyme <span class="text-danger">*</span></label>
                            <input id="pseudonym" type="text" name="pseudonym" class="form-control">
                        </div>

                        <div class="mb-3">
                            <p class="mb-2">Captcha <span class="text-danger">*</span></p>
                            <div class="g-recaptcha" data-sitekey="6LeLh4QfAAAAAFqUCtrlAPEuWyY4uVAOEe8OxdzL"></div>
                        </div>

                        <div>
                            <input value="Créer mon compte" type="submit" class="btn btn-success col-12">
                        </div>

                        <p class="text-danger mt-4">* Champs obligatoires</p>

                    </form>

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