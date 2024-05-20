<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$idProduit = $_GET['idProduit'];

$produit = recupProduitInfo($pdo, $idProduit);

if ($produit['visible'] == 0) {
    $visible = 1;
} else {
    $visible = 0;
}

deleteProduit($pdo, $visible, $idProduit);

$tab = explode('/', $_SERVER['HTTP_REFERER']);
//récupère toute l'url
$urlreferer = '../public/' . $tab[count($tab) - 1];
//récupère la dernière partie de l'url 
header('Location:' . $urlreferer);