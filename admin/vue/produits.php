<?php
$produits = recupProduits($pdo, 0);
$licences = recupLicences($pdo);
$marques = recupMarques($pdo);
$materiaux = recupMateriaux($pdo);
?>

<main class="produits">
    <section>
        <h1 class="py-5 text-center">Produits</h1>
        <?php
        if (isset($_GET['clic'])) {
            if ($_GET['clic'] == 'ajouter') {
        ?>
                <form class="text-center color-snowy" method="post" action="../controler/traitement_ajout_produit.php" enctype="multipart/form-data">

                    <label class="form-label">Matériaux</label>
                    <div class="d-md-flex justify-content-center align-items-center mb-4 py-2">

                        <?php
                        foreach ($materiaux as $materiau) { ?>
                            <div class="form-check form-check-inline mx-4 my-2">
                                <input class="form-check-input" type="checkbox" name="materiau[]" id="materiau" value="<?php echo htmlspecialchars($materiau['id_materiau'], ENT_QUOTES, 'UTF-8'); ?>" />

                                <label class="form-check-label"><?php echo htmlspecialchars($materiau['nom_materiau'], ENT_QUOTES, 'UTF-8'); ?></label>
                            </div>
                        <?php } ?>

                    </div>

                    <label for="licence" class="form-label">Licence</label>
                    <select class="form-select form-select-lg" name="licence" id="licence">
                        <option value="">Sélectionnez une licence</option>
                        <?php foreach ($licences as $licence) { ?>
                            <option value="<?php echo htmlspecialchars($licence['id_licence'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($licence['nom_licence'], ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php } ?>
                    </select>

                    <label for="marque" class="form-label">Marque</label>
                    <select class="form-select form-select-lg" name="marque" id="marque">
                        <option value="">Sélectionnez une marque</option>
                        <?php foreach ($marques as $marque) { ?>
                            <option value="<?php echo htmlspecialchars($marque['id_marque'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($marque['nom_marque'], ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php } ?>
                    </select>

                    <label for="nomProduit" class="form-label">Nom</label>
                    <input type="text" class="form-control form-control-lg" id="nomProduit" name="nomProduit" value="">

                    <label for="prixProduit" class="form-label">Prix</label>
                    <input type="text" class="form-control form-control-lg" id="prixProduit" name="prixProduit" value="">

                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control form-control-lg" id="description" name="description" value="">

                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control form-control-lg" id="stock" name="stock" value="">

                    <label for="dimension" class="form-label">Hauteur (cm)</label>
                    <input type="number" class="form-control form-control-lg" id="dimension" name="dimension" value="">

                    <label for="imgProduit" class="form-label d-block">Image</label>
                    <input type="file" class="form-control form-control-lg" id="imgProduit" name="imgProduit">

                    <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Ajouter" name="add">

                    <a href="../public/index.php?page=3" class="d-block">Annuler</a>

                </form>
            <?php }
        } else {
            ?>
            <a href="../public/index.php?page=3&clic=ajouter">Ajouter un produit</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Nom</th>
                        <th scope="col" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($produits as $produit) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8'); ?></th>
                            <td><img class="img-bo w-25" src="<?php echo "../../".htmlspecialchars($produit['image_produit'], ENT_QUOTES, 'UTF-8'); ?>" alt=""></td>
                            <td><?php echo htmlspecialchars($produit['nom_produit'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-eye"></i></button></td>
                            <td><a href="index.php?page=9&idProduit=<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8'); ?>" class="text-black text-decoration-none">Edit</a></td>
                            <td><a href="../controler/traitement_delete_produit.php?idProduit=<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8'); ?>"><i class="fa-solid fa-trash-can text-black"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>

        <!-- Modale  -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>