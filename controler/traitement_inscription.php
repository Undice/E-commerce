<?php

require "../modele/connexionbdd.php";
require "../modele/fonctions.php";

// si manque d'informations, mettre un pop up "manque d'informations"
$prenom = $_POST['prenom'];
$nomUser = $_POST['nom'];
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
$sexe = $_POST['sexe'];
$anniversaire = $_POST['anniversaire'];
$mdp = $_POST['mdp'];
$confirmationMdp = $_POST['mdpConfirm'];

$ville = $_POST['villeDept'];
$tabVilles = explode('-',$ville);
$idVille = $tabVilles[0];
$cpVille = $tabVilles[1];
$adresse = $_POST['adresse'];

if($mdp == $confirmationMdp) {
    $userExiste = verifUserExiste($pdo, $email);
    if ($userExiste) {
        header('Location:../public/index.php?page=6&erreur=emailExiste');
    } else {
        $hashMdp = password_hash($mdp, PASSWORD_DEFAULT);
        $idUser = insertUser($pdo, $prenom, $nomUser, $email, $hashMdp, $tel, $sexe, $anniversaire);
        insertAdresse($pdo, $adresse, $idUser, $idVille, $cpVille);
        header('Location:../public/index.php?page=5&success=compteCree');
    }
} else {
    header('Location:../public/index.php?page=6&erreur=confirmMdp');
}

?>