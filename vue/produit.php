<?php
require '../controler/pagination.php';

$idProduit = $_GET['idProduit'];
$produit = recupFigurine($pdo, $idProduit);
$stock = $produit['stock'];

if (isset($_SESSION['idUser'])) {
    $favoris = verifFavorisExiste($pdo, $_SESSION['idUser'], $idProduit);

    if ($favoris != '') {
        $coeur = 'fa-solid';
    } else {
        $coeur = 'fa-regular';
    }
}
?>

<main>
    <nav aria-label="breadcrumb" class="m-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../public/index.php?">Accueil</a></li>
            <li class="breadcrumb-item"><a href="../public/index.php?page=1">Boutique</a></li>
            <li class="breadcrumb-item"><a href="../public/index.php?page=1&idCated=<?php echo htmlspecialchars($produit['id_categorie'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($produit['nom_categorie'], ENT_QUOTES, 'UTF-8'); ?></a></li>
            <li class="breadcrumb-item"><a href="../public/index.php?page=1&idMarque=<?php echo htmlspecialchars($produit['id_marque'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($produit['nom_marque'], ENT_QUOTES, 'UTF-8'); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($produit['nom_produit'], ENT_QUOTES, 'UTF-8'); ?></li>
        </ol>
    </nav>
    <!-- <section>

        <h1 class="text-center"><?php //echo htmlspecialchars($produit['nom_produit'], ENT_QUOTES, 'UTF-8'); 
                                ?></h1>
        <div id="carouselExample" class="carousel slide m-5">
             <div class="carousel-inner">
                <div class="carousel-item active">
        <div class="d-flex justify-content-center align-items-center m-5">
            <img class="img-fluid" src="<?php //echo "../" . htmlspecialchars($produit['image_produit'], ENT_QUOTES, 'UTF-8'); 
                                        ?>" alt="...">
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
        <p class="h2 text-center"><?php echo htmlspecialchars($produit['prix'], ENT_QUOTES, 'UTF-8'); ?>€</p>




        <div class="row my-4 text-center">
            <div class="col-lg-2 col-sm-12 border-end">
                <div class="row px-5">
                    <a class="col-lg-12 col m-3 btn bg-db text-light px-3 py-2"><?php echo htmlspecialchars($produit['nom_licence'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <a class="col-lg-12 col m-3 btn bg-db text-light px-3 py-2">Hauteur :<?php echo htmlspecialchars($produit['dimension'], ENT_QUOTES, 'UTF-8'); ?> cm</a>
                    <a class="col-lg-12 col m-3 px-3 py-2"><img src="<?php echo "../" . htmlspecialchars($produit['image_marque'], ENT_QUOTES, 'UTF-8'); ?>" alt="" height="50px" width="auto"></a>
                    <a class="col-lg-12 col m-3 btn bg-db text-light px-3 py-2"><?php echo htmlspecialchars($produit['nom_materiau'], ENT_QUOTES, 'UTF-8'); ?></a>
                </div>
            </div>
            <div class="col-lg-10 col-sm-12 px-5 d-flex align-items-center justify-content-center">
                <p><?php echo htmlspecialchars($produit['description'], ENT_QUOTES, 'UTF-8'); ?> <br><br> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Totam consequuntur ullam ad sunt molestiae explicabo delectus nam ut possimus veniam. Assumenda, aut voluptate harum sequi officiis eligendi, repudiandae eius libero placeat nobis facere, quod ea alias dolore dicta! Facilis, dignissimos vel minima, aliquid consectetur esse, cum sed recusandae consequuntur quibusdam vero dolore impedit itaque distinctio soluta nisi nam nesciunt veritatis voluptatum hic ex fugit ipsam. Maiores ullam, officia quos eveniet eos nobis aliquid non, ab sit esse quo incidunt aspernatur dolorem nemo consectetur excepturi et, optio laborum architecto? Maxime earum ipsum, distinctio placeat eum accusamus minima voluptatem molestias porro at.</p>
            </div>
        </div>



        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">

                    <?php
                    if ($stock != 0) {
                    ?>
                        <form method="post" action="../controler/traitement_panier.php?clic=addProd&idProduit=<?php echo $produit['id_produit']; ?>&idLicence=<?php echo $produit['id_licence']; ?>">
                            <div class="row align-items-center">
                                <div class=" col-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-lg px-2 fw-bold" id="moins">-</button>
                                        <input type="number" class="text-black form-control" id="quantity" name="qte" value="1" min="1" max="<?php echo htmlspecialchars($stock, ENT_QUOTES, 'UTF-8'); ?>" readonly />
                                        <button type="button" class="btn btn-lg px-2 fw-bold" id="plus">+</button>
                                    </div>

                                </div>

                                <div class="col-6 text-center">
                                    <input class="btn bg-red text-light text-uppercase" type="submit" value="Ajouter au panier" />
                                </div>

                                <?php if (isset($_SESSION['idUser'])) { ?>
                                    <div class="col-3">
                                        <a href="../controler/traitement_favoris.php?idProduit=<?php echo htmlspecialchars($idProduit, ENT_QUOTES, 'UTF-8'); ?>"><i class="color-red btn btn-lg <?php echo $coeur; ?> fa-heart"></i></a>
                                    </div>
                                <?php } ?>

                            </div>

                        </form>

                    <?php } else { ?>
                        <div class="row align-items-center">
                            <div class=" col-3">
                            </div>
                            <div class="col-6 text-center">
                                <p class="text-danger text-center">Cet article n'est plus disponible</p>
                            </div>
                            <?php if (isset($_SESSION['idUser'])) { ?>
                                <div class="col-3">
                                    <a href="../controler/traitement_favoris.php?idProduit=<?php echo htmlspecialchars($idProduit, ENT_QUOTES, 'UTF-8'); ?>"><i class="color-red btn btn-lg <?php echo $coeur; ?> fa-heart"></i></a>
                                </div>
                            <?php } ?>
                        <?php } ?>




                         <div class="m-4 text-center">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <p>56 avis</p>
                    </div>

                        </div>
                </div>
            </div>

    </section> -->


    <section>

        <?php
        if (isset($_GET['produit'])) {
            if ($_GET['produit'] == 'ajoute') {
                echo '<p class="alert alert-success text-center">Produit ajouté au panier </p>';
            }
        }
        if (isset($_GET['erreur'])) {
            if ($_GET['erreur'] == 'manqueStock') {
                echo '<p class="alert alert-danger text-center">Le produit n\'est pas disponible dans cette quantité </p>';
            }
        }
        ?>

<form method="post" action="../controler/traitement_panier.php?clic=addProd&idProduit=<?php echo $produit['id_produit']; ?>&idLicence=<?php echo $produit['id_licence']; ?>">

        <div class="row w-75 mx-auto my-5">
            <div class="col-5">
                <!--<div id="carouselExample" class="carousel slide m-5">
             <div class="carousel-inner">
                <div class="carousel-item active"> -->
                <img class="img-fluid" src="<?php echo "../" . htmlspecialchars($produit['image_produit'], ENT_QUOTES, 'UTF-8'); ?>" alt="...">
                <!-- </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> 
        </div>--> 
            </div>

            <div class="col-lg-7 d-flex flex-column justify-content-evenly align-items-center">
               

                        <h1 class="text-center"><?php echo htmlspecialchars($produit['nom_produit'], ENT_QUOTES, 'UTF-8'); ?></h1>
                        <p class="text-center pretty"><?php echo htmlspecialchars($produit['description'], ENT_QUOTES, 'UTF-8'); ?> <br><br> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Totam consequuntur ullam ad sunt molestiae explicabo delectus nam ut possimus veniam. Assumenda, aut voluptate harum sequi officiis eligendi, repudiandae eius libero placeat nobis facere, quod ea alias dolore dicta! Facilis, dignissimos vel minima, aliquid consectetur esse, cum sed recusandae consequuntur quibusdam vero dolore impedit itaque distinctio soluta nisi nam nesciunt veritatis voluptatum hic ex fugit ipsam. Maiores ullam, officia quos eveniet eos nobis aliquid non, ab sit esse quo incidunt aspernatur dolorem nemo consectetur excepturi et, optio laborum architecto? Maxime earum ipsum, distinctio placeat eum accusamus minima voluptatem molestias porro at.</p>
                        <div class="row">
                            <div class="col-3"></div>
                            <p class="col-6 h2 text-center"><?php echo htmlspecialchars($produit['prix'], ENT_QUOTES, 'UTF-8'); ?>€</p>
                            <div class="col-3">
                                <?php if (isset($_SESSION['idUser'])) { ?>
                                    <a class="text-end" href="../controler/traitement_favoris.php?idProduit=<?php echo htmlspecialchars($idProduit, ENT_QUOTES, 'UTF-8'); ?>"><i class="color-red btn btn-lg <?php echo $coeur; ?> fa-heart"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ($stock != 0) { ?>
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-lg px-2 fw-bold" id="moins">-</button>
                                <input type="number" class="text-black form-control" id="quantity" name="qte" value="1" min="1" max="<?php echo htmlspecialchars($stock, ENT_QUOTES, 'UTF-8'); ?>" readonly />
                                <button type="button" class="btn btn-lg px-2 fw-bold" id="plus">+</button>
                            </div>
                            <input class="btn bg-red text-light text-uppercase" type="submit" value="Ajouter au panier" />
                        <?php } else { ?>
                            <p class="text-danger text-center">Cet article n'est plus disponible</p>
                        <?php } ?>
                  
              
            </div>

        </div>

        </form>

    </section>

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