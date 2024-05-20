<main class="connexion d-flex flex-column align-items-center justify-content-center">
    <section class="container text-center">
        <h1 class="pb-5">Se connecter</h1>
        <form class="card p-5" method="post" action="../controler/traitement_connexion.php">
            <div class="d-flex flex-column align-items-center justify-content-center">
                
                <!-- pop up ? -->
                <p class="text-danger">
                        <?php
                        if (isset($_GET['erreur'])) {

                            if ($_GET['erreur'] == 'identifiants') {
                                echo "Erreur de connexion, veuillez vérifier vos identifiants de connexion";
                            } elseif ($_GET['erreur'] == 'psConnecte') {
                                echo "Vous devez d'abord vous connecter pour accéder au panier";
                            }
                        }
                        ?>
                    </p>
                
                <div class="my-4 py-4 px-5 w-100 text-black ">

                        <label class="form-label" for="email">Adresse Email</label>
                        <input type="text" id="email" name="email" class="form-control form-control-lg mb-4"/>

                        <label class="form-label" for="mdp">Mot de passe</label>
                        <i class="btn bi bi-eye-fill" id="eye"></i>
                        <input type="password" id="mdp" name="mdp" class="form-control form-control-lg mb-4">

                    <input class="mb-4 p-3 bg-sand color-snowy border-0" type="submit" value="Se connecter" name="envoyer">

                </div>
            </div>
        </form>
    </section>
</main>