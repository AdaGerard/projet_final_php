<?php
try{

$db = new PDO("mysql:host=localhost;dbname=projet_final_php;charset=utf8","root","");

    //TODO: A enlever avant la mise en ligne, permet d'afficher les erreurs SQL sur la page
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch( Exception $e ){

    die("Problème avec la base de donnée : " . $e->getMessage());

}
?>