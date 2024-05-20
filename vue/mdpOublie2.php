<main class="connexion">
    <section class="container text-center">
        <form class="card card-registration m-5" method="post" action="../controler/traitement_recupMdp3.php">
            <p class="text-danger">
                <?php
                if (isset($_GET['erreur'])) {
                    if ($_GET['erreur'] == 'confirmMdp') {
                        echo "Les mots de passe ne correspondent pas";
                    }
                    if ($_GET['erreur'] == 'mdpDejaModifie') {
                        echo "Le mot de passe a déjà été modifié";
                    }
                }
                ?>
            </p>

            <div class="my-4 py-4 px-5 w-100 text-black">

                <?php
                if (isset($_GET['success'])) {
                    if ($_GET['success'] == 'change') {
                        echo "Le mot de passe a été modifié avec succès";
                    }
                }
                ?>

                <!-- pop up ? -->

                <div class="form-outline mb-4">
                    <label class="form-label" for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" class="form-control form-control-lg">
                    <i class="btn bi bi-eye-fill"></i>
                    <i class="bi bi-eye-slash-fill"></i>
                </div>
                <!-- <input type="hidden" name="idUser" value="<?php // echo htmlspecialchars($idUser, ENT_QUOTES, 'UTF-8'); ?>"> -->
                <div class="form-outline mb-4">
                <label class="form-label" for="mdpConfirm">Confirmer le mot de passe</label>
                    <input type="password" id="mdpConfirm" name="mdpConfirm" class="form-control form-control-lg">
                    <i class="btn bi bi-eye-fill"></i>
                    <i class="bi bi-eye-slash-fill"></i>
                </div>

                <input class="btn btn-lg bg-lb text-white m-2" type="submit" value="Continuer" name="envoyer">
            </div>
            <a href="../public/index.php?page=5" id="register-form-link">Revenir à la connexion</a></p>
        </form>
    </section>
</main>