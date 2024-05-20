<main class="connexion">

    <section class="container text-center pt-5">

        <form class="card card-registration m-5" method="post" action="../controler/traitement_connexion.php">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="../public/assets/images/Power1.jpg" alt="" class="h-100 w-100" />
                </div>
                <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center">

                    <h1 class="mb-5 text-uppercase fs-3 mt-5">connexion</h1>

                    <?php
                    if (isset($_GET['erreur'])) {

                        if ($_GET['erreur'] == 'identifiants') {

                            echo "<p class='alert alert-danger text-center'>Erreur de connexion, veuillez vérifier vos identifiants de connexion</p>";
                        } elseif ($_GET['erreur'] == 'psConnecte') {

                            echo "<p class='alert alert-danger text-center'>Vous devez d'abord vous connecter pour accéder au panier</p>";
                        }
                    }
                    if (isset($_GET['success'])) {

                        if ($_GET['success'] == 'compteCree') {
                            echo "<p class='alert alert-success text-center'>Vous avez réussi à vous inscrire</p>";
                        } elseif ($_GET['success'] == 'envoye') {
                            echo "<p class='alert alert-success text-center'>Un email vous a été envoyé</p>";
                        } elseif ($_GET['success'] == 'change') {
                            echo "<p class='alert alert-success text-center'>Le mot de passe a été modifié avec succès</p>";
                        }
                    }
                    ?>

                    <div class="my-4 py-4 px-5 w-100 text-black border-bottom ">

                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Adresse Email</label>
                            <input type="text" id="email" name="email" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="mdp">Mot de passe</label>
                            <i class="btn bi bi-eye-fill" id="eye"></i>
                            <input type="password" id="mdp" name="mdp" class="form-control form-control-lg password">
                        </div>

                        <!-- <div class="form-group">
                            <input type="checkbox" class="" id="checkbox">
                            <label class="form-label" for="checkbox">Se souvenir de moi</label>
                        </div> -->

                        <input class="btn btn-lg bg-lb text-white m-2" type="submit" value="Se connecter" name="envoyer">

                        <a class="d-block" href="../public/index.php?page=11">Mot de passe oublié ?</a>

                    </div>

                    <p>Pas de compte ? <a href="../public/index.php?page=6" id="register-form-link">Créez un compte</a></p>

                </div>
            </div>
        </form>
        
    </section>

</main>