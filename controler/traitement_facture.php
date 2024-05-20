<?php
session_start();
require('../modele/connexionBdd.php');
require('../modele/fonctions.php');

date_default_timezone_set('Europe/Paris');
$dateFacture = date('Y-m-d h:i:s');

$idPanier = $_SESSION['idPanier'];
$idUser = $_SESSION['idUser'];
$panier = recupAchatPanier($pdo, $idPanier);
$montant = $panier[0]['montant'];
$produits = recupAchatPanier($pdo, $idPanier);

foreach ($produits as $produit) {
    $idProduit = $produit['id_produit'];
    $newStock = $produit['stock'] - $produit['qte_com'];
    updateStock($pdo, $newStock, $idProduit);
}

$numDerniereFacture = recupNumDerniereFacture($pdo, $idUser);
if ($numDerniereFacture) {
    $num_facture = $numDerniereFacture['numero_facture'];
    $tab = explode('_', $num_facture);
    $num = (int)$tab[1] + 1;
    //verifier
} else {
    $num = 1;
}

$num_facture = 'KP' . date('Ym') . '_' . $num;


//vérifier que le panier n'a pas déjà une facture
// if ($qte <= $produit['stock']) {

//si l'utilisateur a bien payé

insertFacture($pdo, $num_facture, $montant, $dateFacture, $idPanier, $idUser);
unset($_SESSION['idPanier']);
header('Location:../public/index.php?page=10');

// } else {
//     header('Location:../public/index.php?page=10');
// }
