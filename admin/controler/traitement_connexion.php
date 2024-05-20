<?php
session_start();

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$mdp = $_POST['mdp'];

$userExiste = verifUserExiste($pdo, $email);

if ($userExiste) {

    if (password_verify($mdp, $userExiste['mdp'])) {

        $_SESSION['idUser'] = $userExiste['id_user'];
        $_SESSION['idRoleUser'] = $userExiste['id_role'];

        header('Location:../public/index.php?page=1');
    } else {

        header('Location:../public/index.php?erreur=identifiants');
    }
} else {

    header('Location:../public/index.php?erreur=identifiants');
}