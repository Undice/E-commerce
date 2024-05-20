<?php
session_start();
$idUser = $_SESSION['recupMdp'];

require('../modele/connexionBdd.php');
require('../modele/fonctions.php');

$mdp = $_POST['mdp'];
$mdpConfirm = $_POST['mdpConfirm'];

if ($mdp == $mdpConfirm) {

    $hashMdp = password_hash($mdp, PASSWORD_DEFAULT);
    updateUserMdp($pdo, $idUser, $hashMdp);
    unset($_SESSION['recupMdp']);
    header('Location:../public/index.php?page=5&success=change');

} else {

    header('Location:../public/index.php?page=11&erreur=confirmMdp');
}