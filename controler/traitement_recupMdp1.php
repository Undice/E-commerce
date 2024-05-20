<?php

require('../modele/connexionBdd.php');
require('../modele/fonctions.php');

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

$userExiste = verifUserExiste($pdo, $email);

if ($userExiste) {

    $idUser = $userExiste['id_user'];
    $recupTokenBDD = recupToken($pdo, $idUser);

    if ($recupTokenBDD) {

        $idTokenBDD = $recupTokenBDD['id_token'];
        supressionToken($pdo, $idTokenBDD);
    }

    $token = bin2hex(random_bytes(15));

    date_default_timezone_set('Europe/Paris');
    $dateDebutToken = date('Y-m-d h:i:s');

    $message = 'Cliquez sur ce lien pour changer le mot de passe : localhost/clea/e-commerce/controler/traitement_recupMdp2.php?idUser= '.$idUser.'&token='.$token;
    mail($email, 'Token temporaire', $message);

    insertToken($pdo, $token, $dateDebutToken, $idUser);
}

header('Location:../public/index.php?page=5&success=envoye');
