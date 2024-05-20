<?php
//FONCTIONS UTILISATEURS

function recupUsers($pdo)
{
    $reqUsers = $pdo->prepare('SELECT * FROM utilisateurs,adresses,villes,departements,roles WHERE utilisateurs.id_role = roles.id_role AND utilisateurs.id_user = adresses.id_user AND adresses.id_ville = villes.id_ville AND villes.id_departement = departements.id_departement ORDER BY utilisateurs.id_role DESC');
    $reqUsers->execute();
    $users = $reqUsers->fetchAll();
    return $users;
}

function recupUserInfo($pdo, $idUser)
{
    $reqInfoUser = $pdo->prepare('SELECT * FROM utilisateurs,adresses,villes,departements,roles WHERE utilisateurs.id_user = adresses.id_user AND adresses.id_ville = villes.id_ville AND villes.id_departement = departements.id_departement AND utilisateurs.id_role = roles.id_role AND utilisateurs.id_user = ?');
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

function insertUser($pdo, $prenomUser, $nomUser, $sexe, $email, $mdp, $telephone, $anniversaire, $idRole)
{
    $reqInsertUser = $pdo->prepare('INSERT INTO utilisateurs(prenom, nom_user, sexe, email, mdp, telephone, anniversaire, id_role) VALUE(?, ?, ?, ?, ?, ?, ?, ?)');
    $reqInsertUser->execute([$prenomUser, $nomUser, $sexe, $email, $mdp, $telephone, $anniversaire, $idRole]);
    return $pdo->lastInsertId();
}

function updateUser($pdo, $prenom, $nom, $email, $tel, $sexe, $anniversaire, $idUser)
{
    $reqUpdateUser = $pdo->prepare('UPDATE utilisateurs SET prenom = ?, nom_user = ?, sexe = ?, email = ?, telephone = ?, anniversaire = ?, id_role = ? WHERE id_user = ?');
    $reqUpdateUser->execute([$pdo, $prenom, $nom, $email, $tel, $sexe, $anniversaire, $idUser]);
}

//FONCTIONS PRODUITS

function recupProduits($pdo, $visible)
{
    $recupProduits = $pdo->prepare('SELECT * FROM produits,marques,licences,categories WHERE produits.id_marque = marques.id_marque AND produits.id_licence = licences.id_licence AND licences.id_categorie = categories.id_categorie AND visible = ? ORDER BY produits.id_produit ASC');
    $recupProduits->execute([$visible]);
    $produits = $recupProduits->fetchAll();
    return $produits;
}

function recupProduitInfo($pdo, $idProduit)
{
    $reqInfoProduit = $pdo->prepare('SELECT * FROM produits,licences,marques WHERE produits.id_licence = licences.id_licence AND produits.id_marque = marques.id_marque AND produits.id_produit = ?');
    $reqInfoProduit->execute([$idProduit]);
    $infoProduit = $reqInfoProduit->fetch();
    return $infoProduit;
}

function verifProduitExiste($pdo, $nomProduit)
{
    $reqProduitExiste = $pdo->prepare('SELECT * FROM produits WHERE nom_produit = ?');
    $reqProduitExiste->execute([$nomProduit]);
    $produitExiste = $reqProduitExiste->fetch();
    return $produitExiste;
}

function insertProduit($pdo, $nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, $idMarque, $date)
{
    $reqInsertProduit = $pdo->prepare('INSERT INTO produits(nom_produit, prix, description, stock, dimension, id_licence, id_marque, date_ajout_produit) VALUE(?, ?, ?, ?, ?, ?, ?, ?)');
    $reqInsertProduit->execute([$nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, $idMarque, $date]);
    return $pdo->lastInsertId();
}

function updateProduit($pdo, $nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, $idMarque, $idProduit)
{
    $reqUpdateProduit = $pdo->prepare('UPDATE produits SET nom_produit = ?, prix = ?, description = ?, stock = ?, dimension = ?, id_licence = ?, id_marque = ? WHERE id_produit = ?');
    $reqUpdateProduit->execute([$nomProduit, $prixProduit, $description, $stock, $dimension, $idLicence, $idMarque, $idProduit]);
}

function  updateImgProduit($pdo, $imgProduit, $idProduit)
{
    $reqUpdateProduit = $pdo->prepare('UPDATE produits SET image_produit = ? WHERE id_produit = ?');
    $reqUpdateProduit->execute([$imgProduit, $idProduit]);
}

function deleteProduit($pdo, $visible, $idProduit)
{
    $reqDeleteProduit = $pdo->prepare('UPDATE produits SET visible = ? WHERE id_produit = ?');
    $reqDeleteProduit->execute([$visible, $idProduit]);
}

//FONCTIONS LICENCES

function recupLicences($pdo)
{
    $reqLicences = $pdo->prepare('SELECT * FROM licences,categories WHERE licences.id_categorie = categories.id_categorie ORDER BY categories.nom_categorie ASC');
    $reqLicences->execute();
    $licences = $reqLicences->fetchAll();
    return $licences;
}

function recupLicenceInfo($pdo, $idLicence)
{
    $reqInfoLicence = $pdo->prepare('SELECT * FROM licences,categories WHERE licences.id_categorie = categories.id_categorie AND id_licence = ?');
    $reqInfoLicence->execute([$idLicence]);
    $infoLicence = $reqInfoLicence->fetch();
    return $infoLicence;
}

function insertLicence($pdo, $nomLicence, $idCateg)
{
    $reqInsertLicence = $pdo->prepare('INSERT INTO licences(nom_licence, id_categorie) VALUE(?, ?)');
    $reqInsertLicence->execute([$nomLicence, $idCateg]);
}

function updateLicence($pdo, $nomLicence, $idCateg, $idLicence)
{
    $reqUpdateLicence = $pdo->prepare('UPDATE licences SET nom_licence = ?, id_categorie = ? WHERE id_licence = ?');
    $reqUpdateLicence->execute([$nomLicence, $idCateg, $idLicence]);
}

//FONCTIONS CATEGORIES

function recupCategs($pdo)
{
    $reqCateg = $pdo->prepare('SELECT * FROM categories ORDER BY id_categorie ASC');
    $reqCateg->execute();
    $categories = $reqCateg->fetchAll();
    return $categories;
}

function recupCategInfo($pdo, $idCateg)
{
    $reqInfoCateg = $pdo->prepare('SELECT * FROM categories WHERE id_categorie = ?');
    $reqInfoCateg->execute([$idCateg]);
    $infoCateg = $reqInfoCateg->fetch();
    return $infoCateg;
}

function insertCateg($pdo, $nomCateg)
{
    $reqInsertCateg = $pdo->prepare('INSERT INTO categories(nom_categorie) VALUE(?)');
    $reqInsertCateg->execute([$nomCateg]);
}

function updateCateg($pdo, $nomCateg, $idCateg)
{
    $reqUpdateCateg = $pdo->prepare('UPDATE categories SET nom_categorie = ? WHERE id_categorie = ?');
    $reqUpdateCateg->execute([$nomCateg, $idCateg]);
}

//FONCTIONS MARQUES

function recupMarques($pdo)
{
    $reqMarques = $pdo->prepare('SELECT * FROM marques ORDER BY id_marque ASC');
    $reqMarques->execute();
    $marques = $reqMarques->fetchAll();
    return $marques;
}

function recupMarqueInfo($pdo, $idMarque)
{
    $reqInfoMarque = $pdo->prepare('SELECT * FROM marques WHERE id_marque = ?');
    $reqInfoMarque->execute([$idMarque]);
    $infoMarque = $reqInfoMarque->fetch();
    return $infoMarque;
}

function verifMarqueExiste($pdo, $nomMarque)
{
    $reqMarqueExiste = $pdo->prepare('SELECT * FROM marques WHERE nom_marque = ?');
    $reqMarqueExiste->execute([$nomMarque]);
    $marqueExiste = $reqMarqueExiste->fetch();
    return $marqueExiste;
}

function insertMarque($pdo, $nomMarque)
{
    $reqInsertMarque = $pdo->prepare('INSERT INTO marques(nom_marque) VALUE(?)');
    $reqInsertMarque->execute([$nomMarque]);
}

function updateMarque($pdo, $nomMarque, $idMarque)
{
    $reqMarque = $pdo->prepare('UPDATE marques SET nom_marque = ? WHERE id_marque = ?');
    $reqMarque->execute([$nomMarque, $idMarque]);
}

function updateImgMarque($pdo, $imgMarque, $idMarque)
{
    $reqMarque = $pdo->prepare('UPDATE marques SET image_marque = ? WHERE id_marque = ?');
    $reqMarque->execute([$imgMarque, $idMarque]);
}

//FONCTIONS MATERIAUX

function recupMateriaux($pdo)
{
    $reqMateriaux = $pdo->prepare('SELECT * FROM materiaux ORDER BY id_materiau ASC');
    $reqMateriaux->execute();
    $materiauxExiste = $reqMateriaux->fetchAll();
    return $materiauxExiste;
}

function recupMateriauInfo($pdo, $idMateriau)
{
    $reqInfoMateriau = $pdo->prepare('SELECT * FROM materiaux WHERE id_materiau = ?');
    $reqInfoMateriau->execute([$idMateriau]);
    $infoMateriau = $reqInfoMateriau->fetch();
    return $infoMateriau;
}

function insertMateriau($pdo, $nomMateriau)
{
    $reqInsertMateriau = $pdo->prepare('INSERT INTO materiaux(nom_materiau) VALUE(?)');
    $reqInsertMateriau->execute([$nomMateriau]);
}

function updateMateriau($pdo, $nomMateriau, $idMateriau)
{
    $reqUpdateMateriau = $pdo->prepare('UPDATE materiaux SET nom_materiau = ? WHERE id_materiau = ?');
    $reqUpdateMateriau->execute([$nomMateriau, $idMateriau]);
}

//FONCTIONS ADRESSES

function verifAdresseExiste($pdo, $adresse, $idVille, $cpVille)
{
    $reqAdresseExiste = $pdo->prepare('SELECT * FROM adresses WHERE adresse = ? AND id_ville = ? AND code_postal = ?');
    $reqAdresseExiste->execute([$adresse, $idVille, $cpVille]);
    $adresseExiste = $reqAdresseExiste->fetch();
    return $adresseExiste;
}

function insertAdresse($pdo, $adresse, $idVille, $cpVille, $idUser)
{
    $reqinsertAdresse = $pdo->prepare('INSERT INTO adresses(adresse, id_ville, code_postal, id_user) VALUES(?, ?, ?, ?)');
    $reqinsertAdresse->execute([$adresse, $idVille, $cpVille, $idUser]);
    return $pdo->lastInsertId();
}

//FONCTIONS DEPARTEMENTS

function recupDepartements($pdo)
{
    $reqDepartement = $pdo->prepare('SELECT * FROM departements ORDER BY id_departement ASC');
    $reqDepartement->execute();
    $departements = $reqDepartement->fetchAll();
    return $departements;
}

//FONCTIONS VILLES

function recupVille($pdo, $idDept)
{
    $reqVillesDept = $pdo->prepare('SELECT * FROM villes WHERE id_departement = ? ORDER BY nom_ville ASC');
    $reqVillesDept->execute([$idDept]);
    $villesDept = $reqVillesDept->fetchAll();
    return $villesDept;
}

//FONCTIONS ROLES

function recupRoles($pdo)
{
    $reqRoleUser = $pdo->prepare('SELECT * FROM roles');
    $reqRoleUser->execute([]);
    $roleUser = $reqRoleUser->fetchAll();
    return $roleUser;
}

//FONCTIONS MATERIAU_PRODUIT

function insertMateriauProduit($pdo, $idProduit, $idMateriau)
{
    $reqInsertDetailsPlat = $pdo->prepare('INSERT INTO materiau_produit(id_produit, id_materiau) VALUE(?, ?)');
    $reqInsertDetailsPlat->execute([$idProduit, $idMateriau]);
}

function recupMateriauProduitWithIdProduit($pdo, $idProduit)
{
    $reqMateriauProduitWithIdProduit = $pdo->prepare('SELECT id_materiau FROM materiau_produit WHERE id_produit = ?');
    $reqMateriauProduitWithIdProduit->execute([$idProduit]);
    $materiauProduitWithIdProduit = $reqMateriauProduitWithIdProduit->fetchAll();
    return $materiauProduitWithIdProduit;
}

function deleteMateriauProduit($pdo, $idProduit)
{
    $deleteMateriauProduit = $pdo->prepare('DELETE FROM materiau_produit WHERE id_produit = ?');
    $deleteMateriauProduit->execute([$idProduit]);
}

// FONCTIONS PROMOTIONS

function insertPromotion($pdo, $descriptionBon, $nbArticlesMin, $taux, $dateDebut, $dateFin)
{
    $reqInsertDetailsPlat = $pdo->prepare('INSERT INTO promotions(description_bon, nb_articles_min, taux, date_debut, date_fin) VALUE(?, ?, ?, ?, ?)');
    $reqInsertDetailsPlat->execute([$descriptionBon, $nbArticlesMin, $taux, $dateDebut, $dateFin]);
    return $pdo->lastInsertId();
}

function recupBons($pdo)
{
    $reqBons = $pdo->prepare('SELECT * FROM promotions');
    $reqBons->execute();
    $bons = $reqBons->fetchAll();
    return $bons;
}

function  updateImgPromotion($pdo, $imgBon, $idBon)
{
    $reqUpdateImgPromotion = $pdo->prepare('UPDATE promotions SET image_promotion = ? WHERE id_bon = ?');
    $reqUpdateImgPromotion->execute([$imgBon, $idBon]);
}

function recupBonInfo($pdo, $idBon)
{
    $reqInfoBon = $pdo->prepare('SELECT * FROM promotions WHERE id_bon = ?');
    $reqInfoBon->execute([$idBon]);
    $infoBon = $reqInfoBon->fetch();
    return $infoBon;
}

function updatePromotion($pdo, $descriptionBon, $nbArticlesMin, $taux, $dateDebut, $dateFin, $idBon) {
    $reqUpdatePromotion = $pdo->prepare('UPDATE promotions SET description_bon = ?, nb_articles_min = ?, taux = ?, date_debut = ?, date_fin = ? WHERE id_bon = ?');
    $reqUpdatePromotion->execute([$descriptionBon, $nbArticlesMin, $taux, $dateDebut, $dateFin, $idBon]);
}
