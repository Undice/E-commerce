PAS OUBLIER DE METTRE ID_USER EN NULLABLE QUAND ON TRANSFERE LOOPING A LA BASE DE DONNEES

<?php
use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

require 'modele/connexionBdd.php';
require 'modele/fonctions.php';

if ( $xlsx = SimpleXLSX::parse('exemple1.xlsx') ) {
    // print_r( $xlsx->rows() );

    $produits = $xlsx->rows();
    $i = -1;
    foreach ($produits as $produit){
        $i++; // idem que $i = $i + 1;
        if ($i != 0){

            // DEBUT TRAITEMENT CATEGORIE
            
            $nomCategorie = $produit[6]; // => Vérifiez bien l'indice dans votre tableau excel
            $categExiste = recupCateg($pdo, $nomCategorie);

            if ($categExiste){

                $idCategorie = $categExiste['id_categorie'];

            }else{ 

                insertCateg($pdo, $nomCategorie);
                $idCategorie = $pdo->lastInsertId();

            }

            // FIN TRAITEMENT CATEGORIE

            

            // DEBUT TRAITEMENT LICENCE

            $nomLicence = $produit[7]; // => Vérifiez bien l'indice dans votre tableau excel

            $licenceExiste = recupLicence($pdo, $nomLicence);

            if ($licenceExiste){ 

                $idLicence = $licenceExiste['id_licence'];

            }else{ 

                insertLicence($pdo, $nomLicence, $idCategorie);
                $idLicence = $pdo->lastInsertId();

            }

            // FIN TRAITEMENT LICENCE



            // DEBUT TRAITEMENT MARQUE
            $nomMarque = $produit[8];
             
            $marqueExiste = recupMarque($pdo, $nomMarque);

            if ($marqueExiste){

                $idMarque = $marqueExiste['id_marque'];
                updateMarque($pdo, $nomMarque, $idMarque);

            }else{ 

               insertMarque($pdo, $nomMarque);
                $idMarque = $pdo->lastInsertId();

            }  

            // DEBUT TRAITEMENT PRODUIT

            $nomProduit = $produit[0];  // => Vérifiez bien l'indice dans votre tableau excel
            $produitExiste = recupProduit($pdo, $nomProduit);
            $prixProduit = $produit[1];
            $description = $produit[2];
            $stock = $produit[3];
            $dimension = $produit[4];
            $nomMateriaux = $produit[5];
            $nomCategorie = $produit[6];
            $nomLicence = $produit[7];
            $nomMarque = $produit[8];

            if ($produitExiste){

                $idProduit = $produitExiste['id_produit'];
                updateProduit($pdo, $idProduit, $nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, $idMarque);

            }else {

                insertProduit($pdo, $nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, $idMarque);
                $idProduit = $pdo->lastInsertId();

            }

            // FIN TRAITEMENT PRODUIT



             // DEBUT TRAITEMENT Matériaux
            
             $materiauxExiste = recupMateriaux($pdo, $nomMateriaux);
 
             if ($materiauxExiste){ 

                 $idMateriaux = $materiauxExiste['id_materiaux'];
                 updateMateriaux($pdo, $nomMateriaux, $idMateriaux);

             }else{ 
                
                 insertMateriaux($pdo, $nomMateriaux);
                 $idMateriaux = $pdo->lastInsertId();

             }

             // FIN TRAITEMENT Matériaux



              // DEBUT TRAITEMENT Matériaux produit

             $materiauxProduitExiste = recupMateriauxProduit($pdo, $idProduit, $idMateriaux);
 
             if (!$materiauxProduitExiste){ 

                 insertMateriauxProduit($pdo, $idProduit, $idMateriaux);

             }

             // FIN TRAITEMENT Matériaux produit
      

        }
    }
} else {
    echo SimpleXLSX::parseError();
}
