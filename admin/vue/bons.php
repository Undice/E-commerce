<?php
date_default_timezone_set('Europe/Paris');

$bons = recupBons($pdo);
?>

<main class="bons">
    <section>
        <h1 class="py-5 text-center">Bon de réduction</h1>
        <?php
        if (isset($_GET['clic'])) {
            if ($_GET['clic'] == 'ajouter') {
        ?>
                <form class="text-center color-snowy" method="post" action="../controler/traitement_ajout_bon.php" enctype="multipart/form-data">

                    <label for="descriptionBon" class="form-label">Description</label>
                    <input type="text" class="form-control form-control-lg" id="descriptionBon" name="descriptionBon" value="">

                    <label for="nbArticlesMin" class="form-label">Nombre d'articles au minimum</label>
                    <input type="number" class="form-control form-control-lg" id="nbArticlesMin" name="nbArticlesMin" value="">

                    <label for="taux" class="form-label">Taux (en %)</label>
                    <input type="number" class="form-control form-control-lg" id="taux" name="taux" value="" />

                    <label for="dateDebut" class="form-label">Date de début</label>
                    <input type="date" class="form-control form-control-lg" id="dateDebut" name="dateDebut" min="<?= date('Y-m-d'); ?>" max="2999-12-31" />

                    <label for="dateFin" class="form-label">Date de fin</label>
                    <input type="date" class="form-control form-control-lg" id="dateFin" name="dateFin" min="<?php echo date('Y-m-d'); ?>" max="2999-12-31" />

                    <label for="imgPromotion" class="form-label d-block">Image</label>
                    <input type="file" class="form-control form-control-lg" id="imgPromotion" name="imgPromotion" />

                    <input class="my-4 p-3 bg-sand color-snowy border-0 mx-auto" type="submit" value="Ajouter" name="add" />

                    <a href="../public/index.php?page=15" class="d-block">Annuler</a>

                </form>
            <?php }
        } else {
            ?>
            <a href="../public/index.php?page=15&clic=ajouter">Ajouter un bon de réduction</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Description</th>
                        <!-- <th scope="col">Produits concernés</th> -->
                        <th scope="col">Nombre d'articles minimum</th>
                        <th scope="col">Taux</th>
                        <th scope="col">Date de début</th>
                        <th scope="col">Date de fin</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($bons as $bon) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($bon['id_bon'], ENT_QUOTES, 'UTF-8'); ?></th>
                            <td><img class="img-bo w-25" src="<?php echo "../../" . htmlspecialchars($bon['image_promotion'], ENT_QUOTES, 'UTF-8'); ?>" alt=""></td>
                            <td><?php echo htmlspecialchars($bon['description_bon'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($bon['nb_articles_min'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($bon['taux'], ENT_QUOTES, 'UTF-8'); ?> %</td>
                            <td><?php echo htmlspecialchars($bon['date_debut'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($bon['date_fin'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><a href="index.php?page=16&idBon=<?php echo htmlspecialchars($bon['id_bon'], ENT_QUOTES, 'UTF-8'); ?>" class="text-black text-decoration-none">Edit</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>
    </section>
</main>