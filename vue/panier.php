<?php
require '../controler/pagination.php';

$detailsPanier = [];
if (isset($_SESSION['idPanier'])) {
    $detailsPanier = recupAchatPanier($pdo, $_SESSION['idPanier']);
}
?>

<main class="panier">
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <section>
                    <h1 class="text-center">Panier</h1>
                    <div class="card m-3">
                        <?php
                        foreach ($detailsPanier as $detailPanier) {
                            if (isset($_SESSION['idUser'])) {
                                $favoris = verifFavorisExiste($pdo, $_SESSION['idUser'], $detailPanier['id_produit']);
                                if ($favoris != '') {
                                    $coeur = 'fa-solid';
                                } else {
                                    $coeur = 'fa-regular';
                                }
                            }
                        ?>
                            <div class="row p-4 border-bottom align-items-center">

                                <div class="col">
                                    <div class="image-container">
                                        <img src="<?php echo "../" . htmlspecialchars($detailPanier['image_produit'], ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <a href="../public/index.php?page=8&idProduit=<?php echo htmlspecialchars($detailPanier['id_produit'], ENT_QUOTES, 'UTF-8'); ?>&idLicence=<?php echo htmlspecialchars($detailPanier['id_licence'], ENT_QUOTES, 'UTF-8'); ?>&idMarque=<?php echo htmlspecialchars($detailPanier['id_marque'], ENT_QUOTES, 'UTF-8'); ?>&idMateriau=<?php echo htmlspecialchars($detailPanier['id_materiau'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($detailPanier['nom_produit'], ENT_QUOTES, 'UTF-8'); ?></a>
                                    <p><?php echo htmlspecialchars($detailPanier['nom_licence'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>

                                <?php if (isset($_SESSION['idUser'])) { ?>
                                    <div class="col">
                                        <a href="../controler/traitement_favoris.php?idProduit=<?php echo htmlspecialchars($detailPanier['id_produit'], ENT_QUOTES, 'UTF-8'); ?>"><i class="color-red btn btn-lg <?php echo $coeur; ?> fa-heart"></i></a>
                                    </div>
                                <?php } ?>

                                <div class="col">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-lg px-2 fw-bold" id="btn-moins-<?php echo $detailPanier['id_produit'] ?>">-</button>
                                        <input type="number" class="text-black form-control" id="quantity-<?php echo $detailPanier['id_produit'] ?>" name="qte" value="<?php echo $detailPanier['qte_com']; ?>" min="1" max="<?php echo htmlspecialchars($detailPanier['stock'], ENT_QUOTES, 'UTF-8'); ?>" readonly />
                                        <button class="btn btn-lg px-2 fw-bold" id="btn-plus-<?php echo $detailPanier['id_produit'] ?>">+</button>
                                    </div>
                                </div>

                                <div class="col">
                                    <p><?php echo htmlspecialchars($detailPanier['prix_unit'], ENT_QUOTES, 'UTF-8'); ?> €</p>
                                </div>

                                <div class="col">
                                    <a href="../controler/traitement_panier.php?clic=suppProd&idProduit=<?php echo htmlspecialchars($detailPanier['id_produit'], ENT_QUOTES, 'UTF-8'); ?>&idPanier=<?php echo htmlspecialchars($detailPanier['id_panier'], ENT_QUOTES, 'UTF-8'); ?>"><i class="btn btn-lg fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <a class="color-red m-5" href="../public/index.php?page=1">
                        < Continuer mes achats</a>
                </section>

                <!--<section>
                    <h1 class="text-center">Mes favoris</h1>
                    <div class="card m-3">
                        <div class="row p-4 border-bottom align-items-center">
                            <div class="col-2"><img class="img-fluid rounded-3" src="../public/assets/images/article-1.jfif"></div>
                            <div class="col-2">
                                <a href="../public/index.php?page=8&idProduit=<?php // echo htmlspecialchars($detailPanier['id_produit'], ENT_QUOTES, 'UTF-8'); 
                                                                                ?>&idLicence=<?php // echo htmlspecialchars($detailPanier['id_licence'], ENT_QUOTES, 'UTF-8'); 
                                                                                                ?>&idMarque=<?php // echo htmlspecialchars($detailPanier['id_marque'], ENT_QUOTES, 'UTF-8'); 
                                                                                                            ?>&idMateriaux=<?php // echo htmlspecialchars($detailPanier['id_materiaux'], ENT_QUOTES, 'UTF-8'); 
                                                                                                                            ?>"><?php // echo htmlspecialchars($detailPanier['nom_personnage'], ENT_QUOTES, 'UTF-8'); 
                                                                                                                                ?></a>
                                <p><?php // echo htmlspecialchars($detailPanier['nom_licence'], ENT_QUOTES, 'UTF-8'); 
                                    ?></p>
                            </div>
                            <div class="col-2">
                                <i class="btn btn-lg fa-solid fa-cart-shopping"></i>
                            </div>
                            <div class="col-2">
                                <div class="def-number-input number-input safari_only">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="btn btn-lg px-2 fw-bold minus">-</button>
                                    <input class="quantity text-black form-control" min="1" max="<?php // echo htmlspecialchars($detailPanier['stock'], ENT_QUOTES, 'UTF-8'); 
                                                                                                    ?>" name="quantity" value="1" type="number">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="btn btn-lg px-2 fw-bold plus">+</button>
                                </div>
                            </div>
                            <div class="col-2"><?php // echo htmlspecialchars($detailPanier['prix_unit'], ENT_QUOTES, 'UTF-8'); 
                                                ?>€</div>
                            <div class="col-2">
                                <i class="btn btn-lg fa-solid fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </section>-->

            </div>

            <aside class="col-3 text-center">
                <div class="p-5 card">
                    <!-- sticky-top -->
                    <div>
                        <label class="form-label" for="code-promo">Un code promo ?</label>
                        <input type="text" class="form-control my-2" id="code-promo" placeholder="Code promo">
                        <button class="btn mb-2 px-3 text-light text-uppercase bg-dark">Ajouter</button>
                    </div>
                    <div class="row">
                        <p class="col-6 border-bottom py-2 text-start"><?php echo htmlspecialchars($nbArticles, ENT_QUOTES, 'UTF-8'); ?> articles</p>
                        <p class="col-6 border-bottom py-2 text-center" id="montant"><?php echo htmlspecialchars($detailsPanier[0]['montant'], ENT_QUOTES, 'UTF-8'); ?> €</p>
                        <p class="col-6 border-bottom py-2 text-start">Livraison</p>
                        <p class="col-6 border-bottom py-2 text-center">Prix</p>
                        <p class="col-6 border-bottom py-2 text-start">Code promo</p>
                        <p class="col-6 border-bottom py-2 text-center">Prix</p>
                    </div>
                    <div>
                        <p class="col-12 py-2 color-red text-center">Total TTC</p>
                        <p class="col-12 text-center" id="montantTTC"><?php echo htmlspecialchars($detailsPanier[0]['montant'], ENT_QUOTES, 'UTF-8'); ?> €</p>
                        <a class="btn mb-2 px-3 text-light text-uppercase bg-red" href="../controler/traitement_facture.php">Payer</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <section class="py-4">

        <h1 class="text-center fs-3">Nouveautés</h1>

        <div id="carouselExample" class="carousel slide my-5">

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="row d-flex align-items-center">
                        <?php foreach ($produitsAccueil as $produitAccueil) { ?>
                            <div class="col-3">
                                <img src="<?php echo "../" . htmlspecialchars($produitAccueil['image_produit'], ENT_QUOTES, 'UTF-8'); ?>" class="carousel-articles" alt="...">
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>

    </section>

</main>