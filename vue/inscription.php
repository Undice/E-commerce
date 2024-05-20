<?php
$departements = recupDepartements($pdo);
date_default_timezone_set('Europe/Paris');
?>

<main class="container text-center mx-auto">

    <form class="card card-registration mb-5" method="post" action="../controler/traitement_inscription.php">

        <?php
        if (isset($_GET['erreur'])) {
            if ($_GET['erreur'] == 'emailExiste') {
                echo "<p class='alert alert-danger text-center'>Vous êtes déjà inscris</p>";
            }
        }

        if (isset($_GET['erreur'])) {
            if ($_GET['erreur'] == 'confirmMdp') {
                echo "<p class='alert alert-danger text-center'>Les mots de passe ne correspondent pas</p>";
            }
        }
        ?>

        <div class="card-body px-5 py-4 text-black">

            <p class="text-start">Vous avez déjà un compte ? <a href="../public/index.php?page=5" id="login-form-link">Se connecter</a></p>

            <div class="px-5">

                <h1 class="mb-5 text-uppercase">Inscription</h1>

                <div class="d-md-flex justify-content-center align-items-center mb-4 py-2">

                    <div class="form-check form-check-inline mx-4 my-2">
                        <input class="form-check-input" type="radio" name="sexe" id="femme" value="femme" />
                        <label class="form-check-label" for="femme">Femme</label>
                    </div>

                    <div class="form-check form-check-inline mx-4 my-2">
                        <input class="form-check-input" type="radio" name="sexe" id="homme" value="homme" />
                        <label class="form-check-label" for="homme">Homme</label>
                    </div>

                    <div class="form-check form-check-inline mx-4 my-2">
                        <input class="form-check-input" type="radio" name="sexe" id="autre" value="autre" />
                        <label class="form-check-label" for="autre">Autre</label>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control form-control-lg" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="nom">Nom de famille</label>
                        <input type="text" id="nom" name="nom" class="form-control form-control-lg" />
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="tel">Numéro de téléphone</label>
                        <input type="tel" id="tel" name="tel" class="form-control form-control-lg">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="anniversaire">Date de naissance</label>
                        <input type="date" id="anniversaire" name="anniversaire" class="form-control form-control-lg" max="<?php echo date('Y-m-d'); ?>">
                    </div>

                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Adresse Email</label>
                    <input type="text" id="email" name="email" class="form-control form-control-lg" />
                </div>

                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="mdp">Mot de passe</label>
                        <input type="password" id="mdp" name="mdp" class="form-control form-control-lg mdp">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="mdpConfirm">Confirmer le mot de passe</label>
                        <input type="password" id="mdpConfirm" name="mdpConfirm" class="form-control form-control-lg mdp">
                    </div>

                </div>

                <i class="btn bi bi-eye-fill" id="eye"></i>

                <div class="form-outline mb-4">
                    <label class="form-label" for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" class="form-control form-control-lg" />
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <label for="dept" class="form-label">Département</label>
                        <select class="form-select form-select-lg" name="dept" id="dept">
                            <?php foreach ($departements as $departement) { ?>
                                <option value="<?php echo htmlspecialchars($departement['id_departement'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($departement['numero'], ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($departement['nom_departement'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php }; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="villeDept" class="form-label">Ville</label>
                        <select class="form-select form-select-lg" name="villeDept" id="villeDept">
                            <option value="">Selectionnez d'abord un département</option>
                        </select>
                    </div>

                </div>

                <div class="d-flex justify-content-center pt-3">
                    <input class="btn btn-lg bg-lb text-white m-2" type="submit" value="S'inscrire" name="connect">
                </div>

            </div>

        </div>

    </form>

</main>