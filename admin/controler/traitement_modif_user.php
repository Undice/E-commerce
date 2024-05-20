<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$idUser = $_GET['idUser'];

$prenom = $_POST['prenom'];
$nomUser = $_POST['nom'];
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
$sexe = $_POST['sexe'];
$anniversaire = $_POST['anniversaire'];

$ville = $_POST['villeDept'];
$tabVilles = explode('-', $ville);
$idVille = $tabVilles[0];
$cpVille = $tabVilles[1];
$adresse = $_POST['adresse'];


$userExiste = verifUserExiste($pdo, $email);
if ($userExiste) {
    header('Location:../public/index.php?page=6&erreur=emailExiste');
} else {
    updateUser($pdo, $prenom, $nomUser, $email, $tel, $sexe, $anniversaire);
    updateAdresse($pdo, $adresse, $idUser, $idVille, $cpVille);
    header('Location:../public/index.php?page=5&success=compteCree');
}
