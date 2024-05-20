<?php

$idCateg = $_GET['idCateg'];
$categInfo = recupCategInfo($pdo, $idCateg);

?>

<main class="categ">
    <section>

        <form class="text-center color-snowy" method="post" action="../controler/traitement_modif_categ.php?idCateg=<?php echo htmlspecialchars($idCateg, ENT_QUOTES, 'UTF-8'); ?>">

            <h1>Catégorie</h1>

            <label for="nomCateg" class="form-label">Nom</label>
            <input type="text" class="form-control form-control-lg" id="nomCateg" name="nomCateg" value="<?php echo htmlspecialchars($categInfo['nom_categorie'], ENT_QUOTES, 'UTF-8'); ?>">

            <input class="my-4 p-3 bg-db text-white border-0 mx-auto d-block" type="submit" value="Modifier" name="add">

            <a href="../public/index.php?page=5" class="d-block">Annuler</a>

        </form>

    </section>
</main>