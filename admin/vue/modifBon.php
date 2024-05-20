<?php

$idBon = $_GET['idBon'];
$bonInfo = recupBonInfo($pdo, $idBon);

?>

<main class="promotions">
    <section>

        <form class="text-center color-snowy" method="post" action="../controler/traitement_modif_bon.php?idBon=<?php echo htmlspecialchars($idBon, ENT_QUOTES, 'UTF-8'); ?>">

            <h1>Bon de réduction</h1>

            <label for="descriptionBon" class="form-label">Description</label>
            <input type="text" class="form-control form-control-lg" id="descriptionBon" name="descriptionBon" value="<?php echo htmlspecialchars($bonInfo['description_bon'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="nbArticlesMin" class="form-label">Nombre d'articles au minimum</label>
            <input type="number" class="form-control form-control-lg" id="nbArticlesMin" name="nbArticlesMin" value="<?php echo htmlspecialchars($bonInfo['nb_articles_min'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="taux" class="form-label">Taux (en %)</label>
            <input type="number" class="form-control form-control-lg" id="taux" name="taux" value="<?php echo htmlspecialchars($bonInfo['taux'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="dateDebut" class="form-label">Date de début</label>
            <input type="date" class="form-control form-control-lg" id="dateDebut" name="dateDebut" value="<?php echo htmlspecialchars($bonInfo['date_debut'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="dateFin" class="form-label">Date de fin</label>
            <input type="date" class="form-control form-control-lg" id="dateFin" name="dateFin" value="<?php echo htmlspecialchars($bonInfo['date_fin'], ENT_QUOTES, 'UTF-8'); ?>">

            <input class="my-4 p-3  bg-db text-white border-0 mx-auto" type="submit" value="Modifier" name="add">

            <a href="../public/index.php?page=15" class="d-block">Annuler</a>

        </form>

    </section>
</main>