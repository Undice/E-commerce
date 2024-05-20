<?php


//FONCTIONS IMPORT


//FONCTION CATEGORIES IMPORT

function recupCateg($pdo, $nomCategorie)
{
    $reqCateg = $pdo->prepare('SELECT * FROM categories WHERE nom_categorie = ?');
    $reqCateg->execute([$nomCategorie]);
    $categ = $reqCateg->fetch();
    return $categ;
}

function insertCateg($pdo, $nomCategorie)
{
    $reqInsertCateg = $pdo->prepare('INSERT INTO categories(nom_categorie) VALUE(?)');
    $reqInsertCateg->execute([$nomCategorie]);
}

//FONCTIONS LICENCES IMPORT

function recupLicence($pdo, $nomLicence)
{
    $reqLicence = $pdo->prepare('SELECT * FROM licences WHERE nom_licence = ?');
    $reqLicence->execute([$nomLicence]);
    $licence = $reqLicence->fetch();
    return $licence;
}

function insertLicence($pdo, $nomLicence, $idCategorie)
{
    $reqInsertLicence = $pdo->prepare('INSERT INTO licences(nom_licence, id_categorie) VALUE(?, ?)');
    $reqInsertLicence->execute([$nomLicence, $idCategorie]);
}


//FONCTIONS PRODUITS IMPORT

function recupProduit($pdo, $nomProduit)
{
    $reqProduit = $pdo->prepare('SELECT * FROM produits WHERE nom_produit = ?');
    $reqProduit->execute([$nomProduit]);
    $produit = $reqProduit->fetch();
    return $produit;
}

function insertProduit($pdo, $nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, $idMarque)
{
    $reqInsertProduit = $pdo->prepare('INSERT INTO produits(nom_produit, prix, description, stock, dimension, id_licence, visible, id_marque) VALUE(?, ?, ?, ?, ?, ?, ?, ?)');
    $reqInsertProduit->execute([$nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, 0, $idMarque]);
}

//FONCTIONS MATERIAUX IMPORT

function recupMateriaux($pdo, $nomMateriaux)
{
    $reqMateriaux = $pdo->prepare('SELECT * FROM materiaux WHERE nom_materiaux = ?');
    $reqMateriaux->execute([$nomMateriaux]);
    $materiauxExiste = $reqMateriaux->fetch();
    return $materiauxExiste;
}

function updateMateriaux($pdo, $nomMateriaux, $idMateriaux)
{
    $reqMateriaux = $pdo->prepare('UPDATE materiaux SET nom_materiaux = ? WHERE id_materiau = ?');
    $reqMateriaux->execute([$nomMateriaux, $idMateriaux]);
}

function insertMateriaux($pdo, $nomMateriaux)
{
    $reqInsertMateriaux = $pdo->prepare('INSERT INTO materiaux(nom_materiaux) VALUE(?)');
    $reqInsertMateriaux->execute([$nomMateriaux]);
}

//FONCTIONS MATERIAU_PRODUIT IMPORT

function recupMateriauxProduit($pdo, $idProduit, $idMateriaux)
{
    $reqMateriauxProduit = $pdo->prepare('SELECT * FROM materiau_produit WHERE id_produit = ? AND id_materiau = ?');
    $reqMateriauxProduit->execute([$idProduit, $idMateriaux]);
    $materiauxProduitExiste = $reqMateriauxProduit->fetch();
    return $materiauxProduitExiste;
}

function insertMateriauxProduit($pdo, $idProduit, $idMateriaux)
{
    $reqInsertMateriauxProduit = $pdo->prepare('INSERT INTO materiau_produit VALUE(?,?)');
    $reqInsertMateriauxProduit->execute([$idProduit, $idMateriaux]);
}

//FONCTIONS MARQUE IMPORT

function recupMarque($pdo, $nomMarque)
{
    $recupMarque = $pdo->prepare('SELECT * FROM marques WHERE nom_marque = ?');
    $recupMarque->execute([$nomMarque]);
    $marqueExiste = $recupMarque->fetch();
    return $marqueExiste;
}

function updateMarque($pdo, $nomMarque, $idMarque)
{
    $reqMarque = $pdo->prepare('UPDATE marques SET nom_marque = ? WHERE id_marque = ?');
    $reqMarque->execute([$nomMarque, $idMarque]);
}

function insertMarque($pdo, $nomMarque)
{
    $reqInsertMarque = $pdo->prepare('INSERT INTO marques(nom_marque) VALUE(?)');
    $reqInsertMarque->execute([$nomMarque]);
}

//FIN FONCTIONS IMPORT

function recupPrixUnitProduit($pdo, $idProduit)
{
    $recupPrixUnitProduit = $pdo->prepare('SELECT prix as prix FROM produits WHERE id_produit = ?');
    $recupPrixUnitProduit->execute([$idProduit]);
    $prixUnitProduit = $recupPrixUnitProduit->fetch();
    return $prixUnitProduit['prix'];
}

function recupQteCom($pdo, $idPanier, $idProduit)
{
    $recupQteCom = $pdo->prepare('SELECT qte_com FROM details_panier WHERE id_produit = ? AND id_panier = ?');
    $recupQteCom->execute([$idProduit, $idPanier]);
    $qteCom = $recupQteCom->fetch();
    return $qteCom;
}

function updateStock($pdo, $newStock, $idProduit)
{
    $reqUpdatePanierUser = $pdo->prepare('UPDATE produits SET stock = ? WHERE id_produit = ?');
    $reqUpdatePanierUser->execute([$newStock, $idProduit]);
}

function recupFigurine($pdo, $idProduit)
{
    $recupDetailsToProduit = $pdo->prepare('SELECT * FROM produits,materiau_produit,materiaux,marques,licences,categories WHERE produits.id_produit = materiau_produit.id_produit AND materiau_produit.id_materiau = materiaux.id_materiau AND produits.id_marque = marques.id_marque AND produits.id_licence = licences.id_licence AND licences.id_categorie = categories.id_categorie AND produits.id_produit = ?');
    $recupDetailsToProduit->execute([$idProduit]);
    $figurine = $recupDetailsToProduit->fetch();
    return $figurine;
}



function creationPanier($pdo, $id_user, $date, $montant)
{
    $reqCreatPanierUser = $pdo->prepare('INSERT INTO paniers(date_creation, id_user, montant) VALUES(?,?,?)');
    $reqCreatPanierUser->execute([$date, $id_user, $montant]);
    $idPanier = $pdo->lastInsertId();
    return $idPanier;
}

function verifPanier($pdo, $idPanier)
{
    $reqPanier = $pdo->prepare(' SELECT * FROM paniers WHERE id_panier = ?');
    $reqPanier->execute([$idPanier]);
    $panier = $reqPanier->fetch();
    return $panier;
}

function updatePanierUser($pdo, $id_user, $id_panier)
{
    $reqUpdatePanierUser = $pdo->prepare('UPDATE paniers SET id_user = ? WHERE id_panier = ?');
    $reqUpdatePanierUser->execute([$id_user, $id_panier]);
}

function creationDetailsPanier($pdo, $idProduit, $idPaniers, $qteCom, $prixProduit)
{
    $reqCreatDetailsPanier = $pdo->prepare('INSERT INTO details_panier(id_produit, id_panier, qte_com, prix_unit) VALUES(?,?,?,?)');
    $reqCreatDetailsPanier->execute([$idProduit, $idPaniers, $qteCom, $prixProduit]);
}

function recupAchatPanier($pdo, $idPanier)
{
    $reqAchatPanier = $pdo->prepare('SELECT * FROM produits,details_panier,paniers,materiau_produit,materiaux,marques,licences,categories WHERE produits.id_produit = details_panier.id_produit AND details_panier.id_panier = paniers.id_panier AND produits.id_produit = materiau_produit.id_produit AND materiau_produit.id_materiau = materiaux.id_materiau AND produits.id_marque = marques.id_marque AND produits.id_licence = licences.id_licence AND licences.id_categorie = categories.id_categorie AND paniers.id_panier = ? GROUP BY produits.id_produit');
    $reqAchatPanier->execute([$idPanier]);
    $achatPanier = $reqAchatPanier->fetchAll();
    return $achatPanier;
}

function recupMontantPanier($pdo, $idPanier)
{
    $reqMontantPanier = $pdo->prepare('SELECT montant as montant FROM paniers WHERE paniers.id_panier = ?');
    $reqMontantPanier->execute([$idPanier]);
    $montantPanier = $reqMontantPanier->fetch();
    return $montantPanier['montant'];
}


function recupNbProdsPanier($pdo, $idPanier)
{
    $recupNbProdsPanier = $pdo->prepare('SELECT COUNT(*) as nbProds FROM details_panier WHERE id_panier = ?');
    $recupNbProdsPanier->execute([$idPanier]);
    $nbProdsPanier = $recupNbProdsPanier->fetch();
    return $nbProdsPanier['nbProds'];
}

function verifProduit($pdo, $idProduit, $idPanier)
{
    $reqProduit = $pdo->prepare('SELECT * FROM details_panier,produits WHERE details_panier.id_produit = produits.id_produit AND produits.id_produit = ? AND id_panier = ?');
    $reqProduit->execute([$idProduit, $idPanier]);
    $recupFigurine = $reqProduit->fetch();
    return $recupFigurine;
}

function insertDetailsPanier($pdo, $idProduit, $prixUnit, $qte, $idPanier)
{
    $reqInsertDetailsPanier = $pdo->prepare('INSERT INTO details_panier(id_produit, prix_unit, qte_com, id_panier) VALUES(?,?,?,?)');
    $reqInsertDetailsPanier->execute([$idProduit, $prixUnit, $qte, $idPanier]);
}

function updateQteComPanier($pdo, $qteCom, $idPanier, $idProduit)
{
    $reqUpdateQteComPanier = $pdo->prepare('UPDATE details_panier SET qte_com = qte_com + ? WHERE id_panier = ? AND id_produit = ?');
    $reqUpdateQteComPanier->execute([$qteCom, $idPanier, $idProduit]);
}

function updateMontantPanier($pdo, $montantArticle, $idPanier)
{
    $reqUpdateMontantPanier = $pdo->prepare('UPDATE paniers SET montant = montant + ? WHERE id_panier = ?');
    $reqUpdateMontantPanier->execute([$montantArticle, $idPanier]);
}

function supressionArt($pdo, $idProduit, $idPanier)
{
    $reqsupprArt = $pdo->prepare('DELETE FROM details_panier WHERE id_produit = ? AND id_panier = ?');
    $reqsupprArt->execute([$idProduit, $idPanier]);
}

function supressionPanier($pdo, $idPanier)
{
    $reqsupprPanier = $pdo->prepare('DELETE FROM paniers WHERE id_panier = ?');
    $reqsupprPanier->execute([$idPanier]);
}

function recupUserInfo($pdo, $idUser)
{
    $reqInfoUser = $pdo->prepare('SELECT * FROM utilisateurs,adresses,villes,departements WHERE utilisateurs.id_user = adresses.id_user AND adresses.id_ville = villes.id_ville AND villes.id_departement = departements.id_departement AND utilisateurs.id_user = ?');
    $reqInfoUser->execute([$idUser]);
    $infoUser = $reqInfoUser->fetch();
    return $infoUser;
}

function verifUserExiste($pdo, $email)
{
    $reqUserExiste = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = ?');
    $reqUserExiste->execute([$email]);
    $userExiste = $reqUserExiste->fetch();
    return $userExiste;
}

function insertUser($pdo, $prenom, $nomUser, $email, $hashMdp, $tel, $sexe, $anniversaire)
{
    $reqInsertUser = $pdo->prepare('INSERT INTO utilisateurs(prenom, nom_user, email, mdp, telephone, sexe, anniversaire, id_role) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
    $reqInsertUser->execute([$prenom, $nomUser, $email, $hashMdp, $tel, $sexe, $anniversaire, 1]);
    return $pdo->lastInsertId();
}

function updateUser($pdo, $prenom, $nomUser, $email, $hashMdp, $tel, $sexe, $anniversaire)
{
    $reqUpdateUser = $pdo->prepare('UPDATE utilisateur SET prenom = ?, nom_user = ?, sexe = ?, email = ?, mdp = ?, telephone = ?, anniversaire = ?, id_role = ?');
    $reqUpdateUser->execute([$prenom, $nomUser, $email, $hashMdp, $tel, $sexe, $anniversaire, 1]);
}


function updateUserMdp($pdo, $idUser, $hashMdp)
{
    $reqProduit = $pdo->prepare('UPDATE utilisateurs SET mdp = ? WHERE id_user = ?');
    $reqProduit->execute([$hashMdp, $idUser]);
}

function insertAdresse($pdo, $adresse, $id_user, $idVille, $cpVille)
{
    $reqinsertAdresse = $pdo->prepare('INSERT INTO adresses(adresse, id_user, id_ville, code_postal) VALUES(?, ?, ?, ?)');
    $reqinsertAdresse->execute([$adresse, $id_user, $idVille, $cpVille]);
}

function recupDepartements($pdo)
{
    $reqDepartement = $pdo->prepare('SELECT * FROM departements ORDER BY id_departement ASC');
    $reqDepartement->execute();
    $departements = $reqDepartement->fetchAll();
    return $departements;
}

function recupVille($pdo, $idDept)
{
    $reqVillesDept = $pdo->prepare('SELECT * FROM villes WHERE id_departement = ? ORDER BY nom_ville ASC');
    $reqVillesDept->execute([$idDept]);
    $villesDept = $reqVillesDept->fetchAll();
    return $villesDept;
}

function insertToken($pdo, $token, $dateDebutToken, $idUser)
{
    $reqinsertToken = $pdo->prepare('INSERT INTO tokens(token,date_creation,id_user) VALUES(?, ?, ?)');
    $reqinsertToken->execute([$token, $dateDebutToken, $idUser]);
}

function recupToken($pdo, $idUser)
{
    $reqToken = $pdo->prepare('SELECT * FROM tokens WHERE id_user = ?');
    $reqToken->execute([$idUser]);
    $tokenBDD = $reqToken->fetch();
    return $tokenBDD;
}

function supressionToken($pdo, $idToken)
{
    $reqsupprPanier = $pdo->prepare('DELETE FROM tokens WHERE id_token = ?');
    $reqsupprPanier->execute([$idToken]);
}

function insertFacture($pdo, $num_facture, $montant, $date_facture, $id_panier, $idUser)
{
    $reqinsertFacture = $pdo->prepare('INSERT INTO factures(numero_facture, montant, nb_paiement, date_facturation, id_panier, id_user) VALUES(?, ?, ?, ?, ?, ?)');
    $reqinsertFacture->execute([$num_facture, $montant, 1, $date_facture, $id_panier, $idUser]);
    $idFacture = $pdo->lastInsertId();
    return $idFacture;
}

function recupFacture($pdo, $idUser)
{
    $reqFacture = $pdo->prepare('SELECT * FROM factures WHERE id_user = ? ORDER BY date_facturation DESC');
    $reqFacture->execute([$idUser]);
    $factures = $reqFacture->fetchall();
    return $factures;
}

function recupNumDerniereFacture($pdo, $idUser)
{
    $reqFacture = $pdo->prepare('SELECT numero_facture FROM factures WHERE id_user = ? ORDER BY id_facture DESC LIMIT 1');
    $reqFacture->execute([$idUser]);
    $factures = $reqFacture->fetch();
    return $factures;
}

function verifFacture($pdo, $idUser, $idFacture)
{
    $reqFacture = $pdo->prepare('SELECT * FROM factures,paniers,details_panier,produits,utilisateurs,adresses,villes,departements WHERE factures.id_panier = paniers.id_panier AND paniers.id_panier = details_panier.id_panier AND details_panier.id_produit = produits.id_produit AND utilisateurs.id_user = adresses.id_user AND adresses.id_ville = villes.id_ville AND villes.id_departement = departements.id_departement AND utilisateurs.id_user = ? AND id_facture = ?');
    $reqFacture->execute([$idUser, $idFacture]);
    $factures = $reqFacture->fetchAll();
    return $factures;
}

function recupFavoris($pdo, $idUser)
{
    $reqProduit = $pdo->prepare('SELECT * FROM produits,materiau_produit,materiaux,marques,licences,categories,favoris WHERE produits.id_produit = materiau_produit.id_produit AND materiau_produit.id_materiau = materiaux.id_materiau AND produits.id_marque = marques.id_marque AND produits.id_licence = licences.id_licence AND licences.id_categorie = categories.id_categorie AND produits.id_produit = favoris.id_produit AND favoris.id_user = ? AND visible = 0 GROUP BY produits.id_produit ORDER BY date_ajout_favoris DESC');
    $reqProduit->execute([$idUser]);
    $produit = $reqProduit->fetchAll();
    return $produit;
}

function verifFavorisExiste($pdo, $idUser, $idProduit)
{
    $verifFavorisExiste = $pdo->prepare('SELECT * FROM favoris WHERE id_user = ? AND id_produit = ?');
    $verifFavorisExiste->execute([$idUser, $idProduit]);
    $favorisExiste = $verifFavorisExiste->fetch();
    return $favorisExiste;
}

function supressionFavoris($pdo, $idUser, $idProduit)
{
    $supressionFavoris = $pdo->prepare('DELETE FROM favoris WHERE id_user = ? AND id_produit = ?');
    $supressionFavoris->execute([$idUser, $idProduit]);
}

function creationFavoris($pdo, $idUser, $idProduit, $dateAjout)
{
    $reqCreationFavoris = $pdo->prepare('INSERT INTO favoris(id_user, id_produit, date_ajout_favoris) VALUES(?,?,?)');
    $reqCreationFavoris->execute([$idUser, $idProduit, $dateAjout]);
}

//FONCTIONS PRODUITS 

function recupStockProduit($pdo, $idProduit)
{
    $reqStockProduit = $pdo->prepare('SELECT stock FROM produits WHERE produits.id_produit = ?');
    $reqStockProduit->execute([$idProduit]);
    $stockProduit = $reqStockProduit->fetch();
    return $stockProduit;
}

function countProduits($pdo)
{
    $reqCountProduits = $pdo->prepare('SELECT COUNT(*) as nbProds FROM produits WHERE visible = 0');
    $reqCountProduits->execute();
    $countProduit = $reqCountProduits->fetch();
    return $countProduit['nbProds'];
}

function recupDetailsProduits($pdo, $debut, $limit)
{
    $req = "SELECT * FROM produits,materiau_produit,materiaux,marques,categories,licences WHERE produits.id_produit = materiau_produit.id_produit AND materiau_produit.id_materiau = materiaux.id_materiau AND produits.id_marque = marques.id_marque AND produits.id_licence = licences.id_licence AND licences.id_categorie = categories.id_categorie AND visible = 0 GROUP BY produits.id_produit";
    if (isset($_SESSION['tri'])) {
        $req .= $_SESSION['tri'];
    } else {
        $req .= ' ORDER BY date_ajout_produit DESC';
    }
    $req .= " LIMIT " . $debut . "," . $limit;

    $reqProduits = $pdo->prepare($req);
    $reqProduits->execute();
    $Produits = $reqProduits->fetchAll();
    return $Produits;
}

function recupDetailsProduitsRecherche($pdo, $recherche, $debut, $limit)
{
    $req = $pdo->prepare('SELECT * FROM produits,materiau_produit,materiaux,marques,categories,licences WHERE produits.id_produit = materiau_produit.id_produit AND materiau_produit.id_materiau = materiaux.id_materiau AND produits.id_marque = marques.id_marque AND produits.id_licence = licences.id_licence AND licences.id_categorie = categories.id_categorie AND visible = 0 AND nom_produit LIKE ' . $recherche . '% GROUP BY produits.id_produit LIMIT ' . $debut . ',' . $limit);
    $req->execute();
    $Produit = $req->fetchAll();
    return $Produit;
}

function recupDetailsProduitsEntre($pdo, $prixDebut, $prixFin, $debut, $limit)
{
    $req = $pdo->prepare('SELECT * FROM produits,materiau_produit,materiaux,marques,categories,licences WHERE produits.id_produit = materiau_produit.id_produit AND materiau_produit.id_materiau = materiaux.id_materiau AND produits.id_marque = marques.id_marque AND produits.id_licence = licences.id_licence AND licences.id_categorie = categories.id_categorie AND visible = 0 AND prix BETWEEN $prixDebut AND $prixFin GROUP BY nom_produit LIMIT ' . $debut . ',' . $limit);
    $req->execute();
    $Produit = $req->fetchAll();
    return $Produit;
}

// FONCTIONS PROMOTIONS

function recupPromotions($pdo)
{
    $reqPromotions = $pdo->prepare('SELECT * FROM promotions');
    $reqPromotions->execute();
    $promotions = $reqPromotions->fetchAll();
    return $promotions;
}

// FONCTIONS MARQUES

function recupMarques($pdo, $debut, $limit)
{
    $reqMarques = $pdo->prepare('SELECT * FROM marques ORDER BY id_marque ASC LIMIT ' . $debut . "," . $limit);
    $reqMarques->execute();
    $marques = $reqMarques->fetchAll();
    return $marques;
}

function countMarques($pdo)
{
    $reqCountMarques = $pdo->prepare('SELECT COUNT(*) as nbMarques FROM marques');
    $reqCountMarques->execute();
    $countMarque = $reqCountMarques->fetch();
    return $countMarque['nbMarques'];
}

// FONCTIONS MESSAGES

function insertMessage($pdo, $date, $nom, $sujet, $email, $message)
{
    $reqinsertToken = $pdo->prepare('INSERT INTO messages(date_message, nom, sujet, email, message) VALUES(?, ?, ?, ?, ?)');
    $reqinsertToken->execute([$date, $nom, $sujet, $email, $message]);
}
