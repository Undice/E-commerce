<?php
session_start();

require "../modele/connexionbdd.php";
require "../modele/fonctions.php";

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$mdp = $_POST['mdp'];

$userExiste = verifUserExiste($pdo, $email);

if ($userExiste) {
    if (password_verify($mdp, $userExiste['mdp'])) {
        
        $_SESSION['idUser'] = $userExiste['id_user'];
        $_SESSION['idRoleUser'] = $userExiste['id_role'];

        if (isset($_SESSION['idPanier'])) {

            $panier = verifPanier($pdo, $idPanier);
            $userPanier = $panier['id_user'];

            if ($userPanier == NULL) {
                updatePanierUser($pdo, $_SESSION['idUser'], $_SESSION['idPanier']);
            } else {
                unset($_SESSION['idPanier']);
            }
        }
        header('Location:../public/index.php?'); //redirection vers l'acceuil
    } else {
        header('Location:../public/index.php?page=5&erreur=identifiants');
        //redirection vers le formulaire de connexion
    }
} else {
    header('Location:../public/index.php?page=5&erreur=identifiants');
    //redirection vers le formulaire de connexion
}
