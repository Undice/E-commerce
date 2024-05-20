<?php
$licences = recupLicences($pdo);
$categories = recupCategs($pdo);
?>

<main class="licences">
    <section>
        <h1 class="py-5 text-center">Licences</h1>
        <?php
        if (isset($_GET['clic'])) {
            if ($_GET['clic'] == 'ajouter') {
        ?>
                <form class="text-center color-snowy" method="post" action="../controler/traitement_ajout_licence.php">

                    <label for="nomLicence" class="form-label">Nom</label>
                    <input type="text" class="form-control form-control-lg" id="nomLicence" name="nomLicence" value="">

                    <label for="categorie" class="form-label">Categorie</label>
                    <select class="form-select form-select-lg" name="categorie" id="categorie">
                        <option value="">Sélectionnez une categorie</option>
                        <?php foreach ($categories as $categorie) { ?>
                            <option value="<?php echo htmlspecialchars($categorie['id_categorie'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($categorie['nom_categorie'], ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php } ?>
                    </select>

                    <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Ajouter" name="add">

                    <a href="../public/index.php?page=4" class="d-block">Annuler</a>

                </form>
            <?php }
        } else {
            ?>
            <a href="../public/index.php?page=4&clic=ajouter">Ajouter une Licence</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Catégories</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($licences as $licence) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($licence['id_licence'], ENT_QUOTES, 'UTF-8'); ?></th>
                            <td><?php echo htmlspecialchars($licence['nom_licence'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($licence['nom_categorie'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><a href="index.php?page=10&idLicence=<?php echo htmlspecialchars($licence['id_licence'], ENT_QUOTES, 'UTF-8'); ?>" class="text-black text-decoration-none">Edit</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>
    </section>
</main>