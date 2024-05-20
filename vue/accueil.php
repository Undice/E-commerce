<?php
require '../controler/pagination.php';
?>

<main class="accueil">

    <section class="pb-4">

        <div id="carouselExampleCaptions" class="carousel slide my-5" data-bs-ride="carousel">

            <div class="carousel-indicators">
                <?php $nb = 0;
                $slideNb = 1;
                foreach ($promotions as $promotion) { ?>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $nb; ?>" <?php if ($promotion['id_bon'] == $promotions[0]['id_bon']) {
                                                                                                                                echo "class='active' aria-current='true'";
                                                                                                                            } ?> aria-label="Slide <?php echo $slideNb; ?>"></button>
                <?php
                    $nb = $nb + 1;
                    $slideNb = $slideNb + 1;
                } ?>
            </div>

            <div class="carousel-inner">

                <?php foreach ($promotions as $promotion) { ?>
                    <div class="carousel-item <?php if ($promotion['id_bon'] == $promotions[0]['id_bon']) {
                                                    echo "active";
                                                } ?>">
                        <img src="<?php echo "../" . htmlspecialchars($promotion['image_promotion'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h2><?php echo htmlspecialchars($promotion['description_bon'], ENT_QUOTES, 'UTF-8'); ?></h2>
                            <a class="btn bg-red text-light">En savoir plus</a>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        </div>

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

    <section class="py-4">

        <h1 class="text-center fs-3">Toutes les marques</h1>

        <div id="carouselExampleIndicators" class="carousel slide my-5 ">

            <div class="carousel-indicators">
                <?php $nb = 0;
                $slideNb = 1;
                foreach ($marques as $marque) { ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $nb; ?>" <?php if ($marque['id_marque'] == $marques[0]['id_marque']) {
                                                                                                                                echo "class='active' aria-current='true'";
                                                                                                                            } ?> aria-label="Slide <?php echo $slideNb; ?>"></button>
                <?php
                    $nb = $nb + 1;
                    $slideNb = $slideNb + 1;
                } ?>

            </div>

            <div class="carousel-inner">

                <?php foreach ($marques as $marque) { ?>
                    <div class="carousel-item <?php if ($marque['id_marque'] == $marques[0]['id_marque']) {
                                                    echo "active";
                                                } ?>">

                        <div class="row d-flex align-items-center">

                            <div class="col-4">
                                <img src="<?php echo "../" . htmlspecialchars($marque['image_marque'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid" alt="...">
                            </div>

                        </div>

                    </div>
                <?php } ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>

    </section>

</main>