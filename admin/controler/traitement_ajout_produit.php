<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d h:i:s');

$nomProduit = $_POST['nomProduit'];
$prixProduit = $_POST['prixProduit'];
$description = $_POST['description'];
$stock = $_POST['stock'];
$dimension = $_POST['dimension'];
$idMateriaux = $_POST['materiau'];
$idLicence = $_POST['licence'];
$idMarque = $_POST['marque'];

$produitExiste = verifProduitExiste($pdo, $nomProduit);

if ($produitExiste) {

    header('Location:../public/index.php?page=3&erreur=produitExiste');
} else {

    $idProduit = insertProduit($pdo, $nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, $idMarque, $date);

    foreach ($idMateriaux as $idMateriau) {
        insertMateriauProduit($pdo, $idProduit, $idMateriau);
    }

    if (isset($_FILES['imgProduit']) && $_FILES['imgProduit']['name'] != '') {

        $extensions_valides = array('jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG');
        // récupérer la liste des extensions qui sont acceptées

        $extension_upload = pathinfo($_FILES['imgProduit']['name'], PATHINFO_EXTENSION);
        // récupérer l'extension du fichier

        if (in_array($extension_upload, $extensions_valides)) {
            // permet de vérifier si l'extension correspond à celles autorisées

            $dossier = '../../public/assets/images';
            //dirige le dossier vers le fichier image
            $nom = time();
            //permet de donner un nom unique au fichier
            $nom = $nom . '.' . $extension_upload;
            //on récupère le nom et on lui ajoute l'extension
            $chemin = $dossier . "/" . $nom;

            if (move_uploaded_file($_FILES['imgProduit']['tmp_name'], $chemin)) {
                //permet de transférer le fichier

                $chemindansbdd = 'public/assets/images/' . $nom;
                updateImgProduit($pdo, $chemindansbdd, $idProduit);
            } else {

                header('Location:../public/index.php?page=3&erreur=probleme');
            }
        } else {

            header('Location:../public/index.php?page=3&erreur=fichierInvalide');
            //l'extension du fichier ne correspond pas aux extensions autorisées

        }
    }

    header('Location:../public/index.php?page=3');
}
