<?php
// Pagination :
// 1. Récupérer le nombre total de produits à afficher
$nombreTotalProduit = countProduits($pdo);

// 2. Définir le nombre de produits à afficher par page
$limitProduit = 10; //il correspond au nombre d'articles à afficher par page

// 3. Calculer le nombre total de pages en arrondissant à la valeur supérieur
$nombrePagesProduits = ceil($nombreTotalProduit / $limitProduit);

// 4. Récupérer le numéro de la pgae à afficher
$numeroPageProduits = isset($_GET['num_page_produits']) ? $_GET['num_page_produits'] : 1;
//Si la page existe en get, j'affecte le numéro de la page. Sinon la page est la 1

// if (isset($_GET['num_page_produits'])) {
//     $numeroPageProduits = $_GET['num_page_produits'];
// } else {
//     $numeroPageProduits = 1;
// }

// 5. Calculer l'indicez du premier produit de la page à afficher

$debut = ($numeroPageProduits - 1) * $limitProduit;

// 6. Récupérer les produits de la page à afficher avec une boucle

$produits = recupDetailsProduits($pdo, $debut, $limitProduit);

$promotions = recupPromotions($pdo);

$produitsAccueil = recupDetailsProduits($pdo, $debut, 4);






$nombreTotalMarque = countMarques($pdo);

$limitMarque = 3;

$nombrePagesProduits = ceil($nombreTotalMarque / $limitMarque);

$numeroPageMarques = isset($_GET['num_page_marques']) ? $_GET['num_page_marques'] : 1;

$debutMarque = ($numeroPageMarques - 1) * $limitMarque;

$marques = recupMarques($pdo, $debutMarque, $limitMarque);


?>