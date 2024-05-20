<?php
require '../controler/pagination.php';
?>

<main class="boutique">
    <div class="row">
        <div class="col-3 p-0">
            <!-- <div class="sticky-top"> -->
            <div class="d-flex flex-column align-items-center">

                <div class="mt-5 btn bg-db text-white d-flex justify-content-center align-items-center my-3" id="filterButton">
                    <h2 class="me-2">Filtres</h2>
                    <i class="fa-solid fa-chevron-down" id="chevron"></i>
                </div>

                <div class="text-center d-flex flex-column align-items-center d-none" id="filterHide">

                    <form class="my-3 d-flex my-3 align-items-center">
                        <input class="form-control" type="search" placeholder="Rechercher" aria-label="Search">
                        <!-- <i class="btn header-font color-red fw-bold fa-solid fa-magnifying-glass" type="submit"></i> -->
                    </form>

                    <div class="my-3">
                        <label for="minimum_price" class="fs-4">Prix</label>
                        <input type="number" name="min_price" id="minimum_price" class="form-control" />
                        <input type="number" name="max_price" id="maximum_price" class="form-control me-4" />
                        <input type="submit" class="btn bg-lb mt-4">
                    </div>

                    <div class="my-3">
                        <label for="selectTri" class="form-label d-block">Trier les produits</label>
                        <select name="selectTri" id="selectTri">
                            <option value="">Selectionner un tri</option>
                            <option value="croissant">Prix croissant</option>
                            <option value="decroissant">Prix decroissant</option>
                            <option value="alphabetical">Ordre alphabétique</option>
                            <option value="default">Annuler le tri</option>
                        </select>
                    </div>

                </div>

            </div>
        </div>

        <!-- </div> -->

        <div class="col-9 p-0">

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <div class="breadcrumb-item"><a href="../public/index.php?">Accueil</a></div>
                    <div class="breadcrumb-item active" aria-current="page">Boutique</div>
                </ol>
            </nav>

            <div class="grid-boutique">
                <?php
                foreach ($produits as $produit) {

                    if (isset($_SESSION['idUser'])) {
                        $favoris = verifFavorisExiste($pdo, $_SESSION['idUser'], $produit['id_produit']);

                        if ($favoris != '') {
                            $coeur = 'fa-solid';
                        } else {
                            $coeur = 'fa-regular';
                        }
                    }

                    if ($produit['stock'] == 0) {
                        $bg = "bg-secondary";
                    } else {
                        $bg = "bg-lb";
                    }
                ?>
                    <div class="pe-5 pb-5">

                        <a class="card text-decoration-none text-center shadow-boutique <?php echo $bg; ?>" href="../public/index.php?page=8&idProduit=<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8'); ?>">
                            <div class="image-container">
                                <img src="<?php echo "../" . htmlspecialchars($produit['image_produit'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body color-db">
                                <h5 class="card-title text-dark"><?php echo htmlspecialchars($produit['nom_produit'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                <p class="card-text text-dark"><?php echo htmlspecialchars($produit['nom_licence'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text text-dark"><?php echo htmlspecialchars($produit['prix'], ENT_QUOTES, 'UTF-8'); ?> €</p>
                            </div>

                        </a>

                        <?php if (isset($_SESSION['idUser'])) { ?>

                            <a class="p-0 fs-5 position-relative coeur-boutique d-block color-red text-decoration-none <?php echo $coeur; ?> fa-heart" href="../controler/traitement_favoris.php?idProduit=<?php echo $produit['id_produit']; ?>"></a>

                        <?php } ?>

                    </div>
                <?php } ?>
            </div>

            <div class="d-flex justify-content-center align-itms-center pt-5">
                <nav aria-label="Page navigation example">
                    <ul class="pagination d-flex align-items-center justify-content-center">

                        <li class="page-item <?php if ($numeroPageProduits == 1) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href='index.php?page=1&num_page_produits=<?php echo $numeroPageProduits - 1; ?>' aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        <?php for ($i = 1; $i <= $nombrePagesProduits; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='index.php?page=1&num_page_produits=$i'>$i</a></li>";
                        } ?>

                        <li class="page-item <?php if ($numeroPageProduits == $nombrePagesProduits) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href='index.php?page=1&num_page_produits=<?php echo $numeroPageProduits + 1; ?>' aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>

        </div>
    </div>
</main>