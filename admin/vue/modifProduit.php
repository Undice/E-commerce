<?php

$idProduit = $_GET['idProduit'];
$produitInfo = recupProduitInfo($pdo, $idProduit);
$licences = recupLicences($pdo);
$marques = recupMarques($pdo);
$materiaux = recupMateriaux($pdo);
$materiauxFromMateriauProduit = recupMateriauProduitWithIdProduit($pdo, $idProduit);
//récupérer les matériaux du produit

?>

<main class="produits">
    <section>

        <form class="text-center color-snowy" method="post" action="../controler/traitement_modif_produit.php?idProduit=<?php echo htmlspecialchars($idProduit, ENT_QUOTES, 'UTF-8'); ?>" enctype="multipart/form-data">

            <h1>Produit</h1>

            <label class="form-label">Matériaux</label>
            <div class="d-md-flex justify-content-center align-items-center mb-4 py-2">

                <?php
                foreach ($materiaux as $materiau) { ?>
                    <div class="form-check form-check-inline mx-4 my-2">
                        <input class="form-check-input" type="checkbox" name="materiaux[]" id="materiau" value="<?php echo htmlspecialchars($materiau['id_materiau'], ENT_QUOTES, 'UTF-8'); ?>" <?php foreach ($materiauxFromMateriauProduit as $materiauFromMateriauProduit) {
                                                                                                                                                                                                    if ($materiauFromMateriauProduit['id_materiau'] == $materiau['id_materiau']) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    }
                                                                                                                                                                                                } ?> />

                        <label class="form-check-label"><?php echo htmlspecialchars($materiau['nom_materiau'], ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                <?php } ?>

            </div>

            <label for="licence" class="form-label">Licence</label>
            <select class="form-select form-select-lg" name="licence" id="licence">
                <?php foreach ($licences as $licence) { ?>
                    <option value="<?php echo htmlspecialchars($licence['id_licence'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($produitInfo['id_licence'] == $licence['id_licence']) {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>
                        <?php echo htmlspecialchars($licence['nom_licence'], ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
            </select>

            <label for="marque" class="form-label">Marque</label>
            <select class="form-select form-select-lg" name="marque" id="marque">
                <?php foreach ($marques as $marque) { ?>
                    <option value="<?php echo htmlspecialchars($marque['id_marque'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($produitInfo['id_marque'] == $marque['id_marque']) {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>
                        <?php echo htmlspecialchars($marque['nom_marque'], ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
            </select>

            <label for="nomProduit" class="form-label">Nom</label>
            <input type="text" class="form-control form-control-lg" id="nomProduit" name="nomProduit" value="<?php echo htmlspecialchars($produitInfo['nom_produit'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="prixProduit" class="form-label">Prix</label>
            <input type="number" class="form-control form-control-lg" id="prixProduit" name="prixProduit" value="<?php echo htmlspecialchars($produitInfo['prix'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control form-control-lg" id="description" name="description" value="<?php echo htmlspecialchars($produitInfo['description'], ENT_QUOTES, 'UTF-8'); ?>" max="<?php echo date('Y-m-d'); ?>">

            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control form-control-lg" id="stock" name="stock" value="<?php echo htmlspecialchars($produitInfo['stock'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="dimension" class="form-label">Hauteur (cm)</label>
            <input type="number" class="form-control form-control-lg" id="dimension" name="dimension" value="<?php echo htmlspecialchars($produitInfo['dimension'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="imgProduit" class="form-label d-block">Image</label>
            <input type="file" class="form-control form-control-lg" id="imgProduit" name="imgProduit">

            <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Modifier" name="add">

            <a href="../public/index.php?page=3" class="d-block">Annuler</a>

        </form>

    </section>
</main>