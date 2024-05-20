<?php

$idMateriau = $_GET['idMateriau'];
$materiauInfo = recupMateriauInfo($pdo, $idMateriau);

?>

<main class="materiaux">
    <section>

        <form class="text-center color-snowy" method="post" action="../controler/traitement_modif_materiau.php?idMateriau=<?php echo htmlspecialchars($idMateriau, ENT_QUOTES, 'UTF-8'); ?>">

            <h1>Materiau</h1>

            <label for="nomMateriau" class="form-label">Nom</label>
            <input type="text" class="form-control form-control-lg" id="nomMateriau" name="nomMateriau" value="<?php echo htmlspecialchars($materiauInfo['nom_materiau'], ENT_QUOTES, 'UTF-8'); ?>">

            <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Modifier" name="add">

            <a href="../public/index.php?page=7" class="d-block">Annuler</a>

        </form>

    </section>
</main>