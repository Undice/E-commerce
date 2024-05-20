<?php
session_start();

require('../modele/connexionBdd.php');
require('../modele/fonctions.php');

date_default_timezone_set('Europe/Paris');

$dateAjout = date('Y-m-d h:i:s');

$idProduit = $_GET['idProduit'];
$idUser = $_SESSION['idUser'];

$verifFavorisExiste = verifFavorisExiste($pdo, $idUser, $idProduit);

if ($verifFavorisExiste) {
    supressionFavoris($pdo, $idUser, $idProduit);
} else {
    creationFavoris($pdo, $idUser, $idProduit, $dateAjout);
}

$tab = explode('/', $_SERVER['HTTP_REFERER']);
$urlreferer = '../public/' . $tab[count($tab) - 1];
header('Location:' . $urlreferer);