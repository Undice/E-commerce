<?php

$idLicence = $_GET['idLicence'];

$licenceInfo = recupLicenceInfo($pdo, $idLicence);
$categs = recupCategs($pdo);

?>

<main class="licence">
    <section>

        <form class="text-center color-snowy" method="post" action="../controler/traitement_modif_licence.php?idLicence=<?php echo htmlspecialchars($idLicence, ENT_QUOTES, 'UTF-8'); ?>">

            <h1>Licence</h1>

            <label for="nomLicence" class="form-label">Nom</label>
            <input type="text" class="form-control form-control-lg" id="nomLicence" name="nomLicence" value="<?php echo htmlspecialchars($licenceInfo['nom_licence'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="categ" class="form-label">Catégorie</label>
            <select class="form-select form-select-lg" name="categ" id="categ">

                <?php foreach ($categs as $categ) { ?>
                    <option value="<?php echo htmlspecialchars($categ['id_categorie'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($licenceInfo['id_categorie'] == $categ['id_categorie']) {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>
                        <?php echo htmlspecialchars($categ['nom_categorie'], ENT_QUOTES, 'UTF-8'); ?></option>
                <?php }; ?>

            </select>

            <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Modifier" name="add">

            <a href="../public/index.php?page=4" class="d-block">Annuler</a>

        </form>

    </section>
</main>