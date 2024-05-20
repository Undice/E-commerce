<?php
if(isset($_FILES['photo']) && $_FILES['photo'] != null) {
    $extensions_valides = array('jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG'); // les extensions acceptées

    $extension_upload = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION); // récup de l'extension

    if(in_array($extension_upload, $extensions_valides)) { // vérifier si l'extension correspond à celles autorisées
        $dossier = 'img'; //transfère le dossier dans le fichier image
        $nom = time(); //permet de donner un nom unique au fichier
        $nom = $nom.'.'.$extension_upload;
        $chemin = $dossier."/".$nom;

        if(move_uploaded_file($_FILES['photo']['tmp_name'], $chemin)) {
            //permet de transférer le fichier
            echo "Le document à été téléchargé avec succès";
            // INSERT INTO image ...
        }else{
            echo "Un problème s'est produit";
        }
    }else{
        echo "Votre fichier n'est pas valide";
    }
}else{
    echo 'elese';
}

?>