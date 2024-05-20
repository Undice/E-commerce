<?php
$marques = recupMarques($pdo);
?>

<main class="marques">
    <section>
        <h1 class="py-5 text-center">Marques</h1>
        <?php
        if (isset($_GET['clic'])) {
            if ($_GET['clic'] == 'ajouter') {
        ?>
                <form class="text-center color-snowy" method="post" action="../controler/traitement_ajout_marque.php" enctype="multipart/form-data">

                    <label for="nomMarque" class="form-label">Nom</label>
                    <input type="text" class="form-control form-control-lg" id="nomMarque" name="nomMarque" value="">

                    <label for="imgMarque" class="form-label d-block">Image</label>
                    <input type="file" class="form-control form-control-lg" id="imgMarque" name="imgMarque">

                    <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Ajouter" name="add">

                    <a href="../public/index.php?page=6" class="d-block">Annuler</a>

                </form>
            <?php }
        } else {
            ?>
            <a href="../public/index.php?page=6&clic=ajouter">Ajouter une marque</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Nom</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($marques as $marque) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($marque['id_marque'], ENT_QUOTES, 'UTF-8'); ?></th>
                            <td><img class="img-bo" src="<?php echo "../../".htmlspecialchars($marque['image_marque'], ENT_QUOTES, 'UTF-8'); ?>" alt=""></td>
                            <td><?php echo htmlspecialchars($marque['nom_marque'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><a href="index.php?page=12&idMarque=<?php echo htmlspecialchars($marque['id_marque'], ENT_QUOTES, 'UTF-8'); ?>" class="text-black text-decoration-none">Edit</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>
    </section>
</main>