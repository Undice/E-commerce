<?php

$idMarque = $_GET['idMarque'];
$marqueInfo = recupMarqueInfo($pdo, $idMarque);

?>

<main class="marques">
    <section>

        <form class="text-center color-snowy" method="post" action="../controler/traitement_modif_marque.php?idMarque=<?php echo htmlspecialchars($idMarque, ENT_QUOTES, 'UTF-8'); ?>" enctype="multipart/form-data">

            <h1>Marque</h1>

            <label for="nomMarque" class="form-label">Nom</label>
            <input type="text" class="form-control form-control-lg" id="nomMarque" name="nomMarque" value="<?php echo htmlspecialchars($marqueInfo['nom_marque'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="imgMarque" class="form-label d-block">Image</label>
            <input type="file" class="form-control form-control-lg" id="imgMarque" name="imgMarque">

            <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Modifier" name="add">

            <a href="../public/index.php?page=6" class="d-block">Annuler</a>

        </form>

    </section>
</main>