<?php

session_start();

require "../modele/connexionbdd.php";
require "../modele/fonctions.php";

// var_dump($_GET);
// die();

if (isset($_GET['recup'])) {

    if ($_GET['recup'] == 'departement') {

        $idDept = $_POST['idDepartement'];
        $villes = recupVille($pdo, $idDept);

        echo json_encode($villes);
    }

    if ($_GET['recup'] == 'qteCom') {

        $idPanier = $_SESSION['idPanier'];

        $action = $_GET['action'];
        $idProduit = $_GET['idProd'];

        $prixUnit = recupPrixUnitProduit($pdo, $idProduit);

        $stock = recupStockProduit($pdo, $idProduit);
        $qte = recupQteCom($pdo, $idPanier, $idProduit);

        if ($action == 'moins') {

            if (2 < $qte) {
                $montantArticle = -$prixUnit;
                $qteCom = -1;
            } else {
                $qteCom = 0;
                $montantArticle = 0;
            }
        } elseif ($action == 'plus') {

            // if ($stock > $qte) {
            $qteCom = 1;
            $montantArticle = $prixUnit;
            // } 
            // else {
            //     $qteCom = 0;
            // $montantArticle = 0;
            // }
        }

        // echo 'prixUnit : ' . $prixUnit . '<br><br>';
        // echo 'action : ' . $action . '<br><br>';
        // echo 'qteCom : ' . $qteCom . '<br><br>';
        // echo 'idPanier : ' . $idPanier . '<br><br>';
        // echo 'idProduit : ' . $idProduit . '<br><br>';
        // echo 'montantArticle : ' . $montantArticle . '<br><br>';
        // die();

        updateQteComPanier($pdo, $qteCom, $idPanier, $idProduit);

        updateMontantPanier($pdo, $montantArticle, $idPanier);

        $montantPanier = recupMontantPanier($pdo, $idPanier);

        // echo $montantPanier;

        echo json_encode($montantPanier);
    }
}
