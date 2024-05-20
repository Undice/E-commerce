<?php

require('../modele/connexionBdd.php');
require('../modele/fonctions.php');

date_default_timezone_set('Europe/Paris');

$date = date('Y-m-d h:i:s');
$nom = $_GET['nom'];
$sujet = $_GET['sujet'];
$email = $_GET['email'];
$message = $_GET['message'];

insertMessage($pdo, $date, $nom, $sujet, $email, $message);
//creer une fonction qui ajoute dans la table messagejkl

header('Location:../public/index.php?page=3&message=valide');

?>