<?php
$materiaux = recupMateriaux($pdo);
?>

<main class="materiaux">
    <section>
        <h1 class="py-5 text-center">Materiaux</h1>
        <?php
        if (isset($_GET['clic'])) {
            if ($_GET['clic'] == 'ajouter') {
        ?>
                <form class="text-center color-snowy" method="post" action="../controler/traitement_ajout_materiau.php">

                    <label for="nomMateriau" class="form-label">Nom</label>
                    <input type="text" class="form-control form-control-lg" id="nomMateriau" name="nomMateriau" value="">

                    <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Ajouter" name="add">

                    <a href="../public/index.php?page=7" class="d-block">Annuler</a>

                </form>
            <?php }
        } else {
            ?>
            <a href="../public/index.php?page=7&clic=ajouter">Ajouter une materiau</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($materiaux as $materiau) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($materiau['id_materiau'], ENT_QUOTES, 'UTF-8'); ?></th>
                            <td><?php echo htmlspecialchars($materiau['nom_materiau'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><a href="index.php?page=13&idMateriau=<?php echo htmlspecialchars($materiau['id_materiau'], ENT_QUOTES, 'UTF-8'); ?>" class="text-black text-decoration-none">Edit</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>
    </section>
</main>