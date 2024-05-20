<?php
$produits = recupProduits($pdo, 1);
$licences = recupLicences($pdo);
$marques = recupMarques($pdo);
$materiaux = recupMateriaux($pdo);
?>

<main class="produits">
    <section>
        <h1 class="py-5 text-center">Produits cachés</h1>

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
                        <td><img class="img-bo" src="<?php echo "../../" . htmlspecialchars($produit['image_produit'], ENT_QUOTES, 'UTF-8'); ?>" alt=""></td>
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

        <!-- Modale  -->

        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        </div> -->

    </section>
</main>