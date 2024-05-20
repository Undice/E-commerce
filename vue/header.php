<?php
require "../modele/connexionbdd.php";
require "../modele/fonctions.php";

$detailsPanier = [];
if (isset($_SESSION['idPanier'])) {
    $detailsPanier = recupAchatPanier($pdo, $_SESSION['idPanier']);
    $nbArticles = count($detailsPanier);
}

// if (isset($_SESSION['idUser'])) {
//     $favoris = recupFavoris($pdo, $_SESSION['idUser']);
//     $nbFavoris = count($favoris);
// }

?>

<header class="fixed-top bg-bg mb-5">

    <nav class="navbar navbar-expand-lg color-red">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand header-font color-red fw-bold ms-3" href="../public/index.php"><img class="img-fluid" src="../public/assets/images/logo.png" alt="logo de la marque kappy"></a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav mx-auto mb-2 mb-lg-0">

                    <div class="nav-item m-2">
                        <a class="nav-link header-font color-red fw-bold" href="../public/index.php?page=1">Boutique</a>
                    </div>

                    <div class="nav-item m-2">
                        <a class="nav-link header-font color-red fw-bold" href="../public/index.php?page=2">Les marques</a>
                    </div>

                    <div class="nav-item m-2">
                        <a class="nav-link header-font color-red fw-bold" href="../public/index.php?page=3">Nous contacter</a>
                    </div>

                    <?php if (isset($_SESSION['idUser'])) {

                        if ($_SESSION['idRoleUser'] == 2 || $_SESSION['idRoleUser'] == 3) {

                    ?>
                            <div class="nav-item m-2">
                                <a class="nav-link header-font color-red fw-bold" href="../admin/public/index.php">Admin <i class="fa-solid fa-screwdriver-wrench"></i></i>
                                </a>
                            </div>
                    <?php }
                    } ?>

                </div>
            </div>

            <div class="nav-item ms-auto m-2">
                <a class="nav-link header-font color-red fw-bold position-relative" href="../public/index.php?page=4"><i class="fa-solid fa-heart"></i>
                </a>
            </div>

            <div class="nav-item m-2 dropdown">
                <button class="btn header-font color-red fw-bold position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-cart-shopping"></i>

                    <?php if (isset($_SESSION['idPanier'])) { ?>
                        <p class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-db w-50 h-50 h6">
                            <?php echo htmlspecialchars($nbArticles, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    <?php } ?>

                </button>
            </div>
            <div class="nav-item m-2">
                <a class="nav-link header-font color-red fw-bold" href="../public/index.php?page=5"><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

        <div class="offcanvas-header">
            <h2 class="mx-auto">Panier</h2>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <?php
            if (!isset($_SESSION['idPanier'])) {
            ?>
                <p class="text-center">Le panier est vide</p>
                <a class="col-6 mx-auto btn bg-lb text-light d-block" href="../public/index.php?page=1">Continuer les achats</a>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="card">
                        <?php
                        foreach ($detailsPanier as $detailPanier) {
                        ?>
                            <div class="row border-bottom align-items-center pt-3">
                                <div class="col-3"><img class="img-fluid" src="<?php echo "../" . htmlspecialchars($detailPanier['image_produit'], ENT_QUOTES, 'UTF-8'); ?>"></div>
                                <div class="col-4">
                                    <a href="../public/index.php?page=8&idProduit=<?php echo htmlspecialchars($detailPanier['id_produit'], ENT_QUOTES, 'UTF-8'); ?>&idLicence=<?php echo htmlspecialchars($detailPanier['id_licence'], ENT_QUOTES, 'UTF-8'); ?>&idMarque=<?php echo htmlspecialchars($detailPanier['id_marque'], ENT_QUOTES, 'UTF-8'); ?>&idMateriaux=<?php echo htmlspecialchars($detailPanier['id_materiau'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($detailPanier['nom_produit'], ENT_QUOTES, 'UTF-8'); ?></a>
                                    <p><?php echo htmlspecialchars($detailPanier['nom_licence'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <div class="col-3"><?php echo htmlspecialchars($detailPanier['prix_unit'], ENT_QUOTES, 'UTF-8'); ?>€</div>
                                <div class="col-2">
                                    <a href="../controler/traitement_panier.php?clic=suppProd&idProduit=<?php echo htmlspecialchars($detailPanier['id_produit'], ENT_QUOTES, 'UTF-8'); ?>&idPanier=<?php echo htmlspecialchars($detailPanier['id_panier'], ENT_QUOTES, 'UTF-8'); ?>"><i class="btn fa-solid fa-trash"></i></a>
                                </div>
                                <p class="text-center">Quantité : <?php echo htmlspecialchars($detailPanier['qte_com'], ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <p class="text-center">Total (hors livraison)</p>
                <p class="text-center"><?php echo htmlspecialchars($detailsPanier[0]['montant'], ENT_QUOTES, 'UTF-8'); ?>€</p>
                <div class="row">
                    <div class="col-6 mx-auto">
                        <a class="btn bg-lb text-light d-block" href="../public/index.php?page=7">Voir mon panier</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</header>