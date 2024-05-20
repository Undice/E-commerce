<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telephone = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
$sexe = $_POST['sexe'];
$anniversaire = $_POST['anniversaire'];
$role = $_POST['role'];
$idRole = $_POST['role'];

$ville = $_POST['villeDept'];
$tabVilles = explode('-', $ville);
$idVille = $tabVilles[0];
$cpVille = $tabVilles[1];
$adresse = $_POST['address'];

$userExiste = verifUserExiste($pdo, $email);

if ($userExiste) {

    // header('Location:../public/index.php?page=6&erreur=emailExiste');
} else {

    $hashMdp = password_hash($mdp, PASSWORD_DEFAULT);
    $adresseExiste = verifAdresseExiste($pdo, $adresse, $idVille, $cpVille);

    if ($adresseExiste) {

        echo "L'adresse est déjà utilisée";
    } else {
        $mdp = bin2hex(random_bytes(5));
        $hashMdp = password_hash($mdp, PASSWORD_DEFAULT);
        $idUser = insertUser($pdo, $prenom, $nom, $sexe, $email, $hashMdp, $telephone, $anniversaire, $idRole);
        insertAdresse($pdo, $adresse, $idVille, $cpVille, $idUser);

        $message = 'Voici votre nouveau mot de passe : ' . $mdp;

        // echo $mdp;
        // die();

        mail($email, 'Mot de passe', $message);
    }

    // echo "pas oublier de creer des roles si non fait";
    header('Location:../public/index.php?page=2');
}
