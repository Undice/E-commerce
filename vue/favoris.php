<?php
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
    $produits = recupFavoris($pdo, $idUser);
    $nbProduit = count($produits);
}
?>

<main>
    <section>
        <h1 class="text-center">Mes favoris</h1>
        <div class="row">

            <?php if (!isset($_SESSION['idUser'])) { ?>
                <p class="text-center">
                    <?php echo "<p class='my-5 text-center'>Vous devez d'abord vous connecter pour ajouter un article aux favoris</p>"; ?>
                </p>
            <?php } elseif ($nbProduit == 0) { ?>
                <p class="text-center">
                    <?php echo "<p class='my-5 text-center'>Vous n'avez pas encore de favoris</p>"; ?>
                </p>
            <?php } else { ?>
                <div class="col-8 card m-5 mx-auto">
                    <?php foreach ($produits as $produit) {
                        $stock = $produit['stock'];
                    ?>
                        <div class="row p-4 border-bottom align-items-center">

                            <div class="col">
                                <div class="image-container">
                                    <img class="img-fluid rounded-3" src="<?php echo "../" . htmlspecialchars($produit['image_produit'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                            </div>

                            <div class="col">
                                <a class="row" href="../public/index.php?page=8&idProduit=<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($produit['nom_produit'], ENT_QUOTES, 'UTF-8'); ?></a>
                                <div class="row">
                                    <?php echo htmlspecialchars($produit['nom_licence'], ENT_QUOTES, 'UTF-8'); ?></div>
                            </div>

                            <div class="col"><?php echo htmlspecialchars($produit['prix'], ENT_QUOTES, 'UTF-8'); ?>€</div>

                            <div class="col">

                                <?php if ($stock != 0) { ?>

                                    <form method="post" action="../controler/traitement_panier.php?clic=addProd&idProduit=<?php echo $produit['id_produit']; ?>&idLicence=<?php echo $produit['id_licence']; ?>">

                                        <input type="hidden" name="qte" value="1" id="quantity">
                                        <input class="btn bg-red text-light text-uppercase" type="submit" value="Ajouter au panier" />

                                    </form>

                                <?php } else { ?>
                                    <p class="text-danger text-center balance">Cet article n'est pas disponible actuellement</p>
                                <?php } ?>

                            </div>

                            <div class="col mx-auto">
                                <a href="../controler/traitement_favoris.php?idProduit=<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8'); ?>"><i class="text-dark btn fa-solid fa-trash"></i></a>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
    </section>
</main>