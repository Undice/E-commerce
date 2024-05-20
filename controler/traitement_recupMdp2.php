<?php
session_start();
require('../modele/connexionBdd.php');
require('../modele/fonctions.php');

$token = $_GET['token'];
$idUser = $_GET['idUser'];

$recupTokenBDD = recupToken($pdo, $idUser);
$tokenBDD = $recupTokenBDD['token'];

if ($token == $tokenBDD) {

    date_default_timezone_set('Europe/Paris');

    $tokenDateCreaRecup = $recupTokenBDD['date_creation'];
    $tokenDateDebut = strtotime($tokenDateCreaRecup);

    $dateFinToken = strtotime(date('Y-m-d h:i:s'));

    $differenceDate = ($dateFinToken - $tokenDateDebut) / 60;
    // date_diff était aussi possible : https://www.php.net/manual/fr/function.date-diff.php

    if ($differenceDate < 15) {
        
        $_SESSION['recupMdp'] = $idUser;
        $idTokenBDD = $recupTokenBDD['id_token'];
        supressionToken($pdo, $idTokenBDD);
        header('Location:../public/index.php?page=12');

    } else {

        $idToken = $recupTokenBDD['id_token'];
        supressionToken($pdo, $idToken);
        header('Location:../public/index.php?page=11&erreur=tokenValid');

    }
} else {
    header('Location:../public/index.php?page=11&erreur=token');
}