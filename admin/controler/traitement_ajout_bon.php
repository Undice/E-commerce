<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$descriptionBon = $_POST['descriptionBon'];
$nbArticlesMin = $_POST['nbArticlesMin'];
$taux = $_POST['taux'];
$dateDebut = $_POST['dateDebut'];
$dateFin = $_POST['dateFin'];

$idBon = insertPromotion($pdo, $descriptionBon, $nbArticlesMin, $taux, $dateDebut, $dateFin);

if (isset($_FILES['imgPromotion']) && $_FILES['imgPromotion']['name'] != '') {

    $extensions_valides = array('jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG');
    // récupérer la liste des extensions qui sont acceptées

    $extension_upload = pathinfo($_FILES['imgPromotion']['name'], PATHINFO_EXTENSION);
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

        if (move_uploaded_file($_FILES['imgPromotion']['tmp_name'], $chemin)) {
            //permet de transférer le fichier

            $chemindansbdd = 'public/assets/images/' . $nom;
            updateImgPromotion($pdo, $chemindansbdd, $idBon);
        } else {

            header('Location:../public/index.php?page=3&erreur=probleme');
        }
    } else {

        header('Location:../public/index.php?page=3&erreur=fichierInvalide');
        //l'extension du fichier ne correspond pas aux extensions autorisées

    }
}

header('Location:../public/index.php?page=15');
