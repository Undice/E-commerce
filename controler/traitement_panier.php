<?php
session_start();

require('../modele/connexionBdd.php');
require('../modele/fonctions.php');

$tab = explode('/', $_SERVER['HTTP_REFERER']);
//récupère toute l'url
$urlreferer = '../public/' . $tab[count($tab) - 1];
//récupère la dernière partie de l'url 

if (isset($_GET['clic'])) {

    $idProduit = $_GET['idProduit'];
    $produit = recupFigurine($pdo, $idProduit);

    $prixUnit = $produit['prix'];
    //on veut supprimer tout le produit pas seulement 1 ?

    if ($_GET['clic'] == 'addProd') {

        $qte = $_POST['qte'];

        $stock = $produit['stock'];
        //dire il reste x stock (dans la page produit) si le stock n'est pas suffisant ?

        $montantArticle = $produit['prix'] * $qte;

        // $idLicence = $_GET['idLicence'];

        if (isset($_SESSION['idPanier'])) {

            $idPanier = $_SESSION['idPanier'];

            if ($qte < $stock) {
                $montantPanier = recupMontantPanier($pdo, $idPanier);
                $verifProduit = verifProduit($pdo, $idProduit, $idPanier);

                if ($verifProduit) {
                    updateQteComPanier($pdo, $qte, $idPanier, $idProduit);
                } else {
        
                    insertDetailsPanier($pdo, $idProduit, $prixUnit, $qte, $idPanier);
                }

                updateMontantPanier($pdo, $montantArticle, $idPanier);
            } else {

                header('Location:' . $urlreferer. '&erreur=manqueStock');
                // redirection vers la vue courante
               
            }
        } else {

            date_default_timezone_set('Europe/Paris');
            $datePanier = date('Y-m-d h:i:s');

            if (isset($_SESSION['idUser'])) {

                $_SESSION['idPanier'] = creationPanier($pdo, $_SESSION['idUser'], $datePanier, $montantArticle);
            } else {

                $_SESSION['idPanier'] = creationPanier($pdo, null, $datePanier, $montantArticle);
            }
            creationDetailsPanier($pdo, $idProduit, $_SESSION['idPanier'], $qte, $prixUnit);
        }
        header('Location:' . $urlreferer);
        // redirection vers la vue courante

    } elseif ($_GET['clic'] == 'suppProd') {

        $idPanier = $_GET['idPanier'];
        $prixUnit = recupPrixUnitProduit($pdo, $idProduit);
        $qteCom = recupQteCom($pdo, $idPanier, $idProduit);
        $qteCom = $qteCom['qte_com'];
        $montantArticlePanier = - ($prixUnit * $qteCom);

        supressionArt($pdo, $idProduit, $idPanier);

        $nbProduitsPanier = recupNbProdsPanier($pdo, $idPanier);
        var_dump(is_numeric(($nbProduitsPanier)));

        if ($nbProduitsPanier == 0) {
            supressionPanier($pdo, $idPanier);
            unset($_SESSION['idPanier']);
        } else {
            $qteCom = -$qteCom;
            updateQteComPanier($pdo, $qteCom, $idPanier, $idProduit);
            updateMontantPanier($pdo, $montantArticlePanier, $idPanier);
        }

        header('Location:' . $urlreferer);
        // redirection vers la vue courante

    }
}
