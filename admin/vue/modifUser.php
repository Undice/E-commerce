<?php

$idUser = $_GET['idUser'];
$userInfo = recupUserInfo($pdo, $idUser);
$departements = recupDepartements($pdo);
$roles = recupRoles($pdo);

?>

<main class="users">
    <section>

        <form class="text-center color-snowy" method="post" action="../controller/traitement_modif_user.php?idUser=<?php echo htmlspecialchars($idUser, ENT_QUOTES, 'UTF-8'); ?>">

            <h1>Utilisateur</h1>

            <div class="d-md-flex justify-content-center align-items-center mb-4 py-2">

                <div class="form-check form-check-inline mx-4 my-2">
                    <input class="form-check-input" type="radio" name="sexe" id="sexe" value="femme" />
                    <label class="form-check-label" for="sexe">Femme</label>
                </div>

                <div class="form-check form-check-inline mx-4 my-2">
                    <input class="form-check-input" type="radio" name="sexe" id="sexe" value="homme" />
                    <label class="form-check-label" for="sexe">Homme</label>
                </div>

                <div class="form-check form-check-inline mx-4 my-2">
                    <input class="form-check-input" type="radio" name="sexe" id="sexe" value="autre" />

                    <label class="form-check-label" for="sexe">Autre</label>
                </div>

            </div>

            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" class="form-control form-control-lg" id="prenom" value="<?php echo htmlspecialchars($userInfo['prenom'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control form-control-lg" id="nom" value="<?php echo htmlspecialchars($userInfo['nom_user'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="tel" class="form-label">Numéro de téléphone</label>
            <input type="tel" id="tel" name="tel" class="form-control form-control-lg" value="<?php echo htmlspecialchars($userInfo['telephone'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="anniversaire" class="form-label">Date de naissance</label>
            <input type="date" id="anniversaire" name="anniversaire" class="form-control form-control-lg" value="<?php echo htmlspecialchars($userInfo['anniversaire'], ENT_QUOTES, 'UTF-8'); ?>" max="<?php echo date('Y-m-d'); ?>">

            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control form-control-lg" id="email" value="<?php echo htmlspecialchars($userInfo['email'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="address" class="form-label">Adresse</label>
            <input type="text" class="form-control form-control-lg" id="address" value="<?php echo htmlspecialchars($userInfo['adresse'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="dept" class="form-label">Département</label>
            <select class="form-select form-select-lg" name="dept" id="dept">
                <?php foreach ($departements as $departement) { ?>
                    <option value="<?php echo $departement['id_departement']; ?>" <?php if($userInfo['id_departement'] == $departement['id_departement']){ echo 'selected'; } ?>><?php echo htmlspecialchars($departement['numero'], ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($departement['nom_departement'], ENT_QUOTES, 'UTF-8'); ?></option>
                <?php }; ?>

            </select>

            <label for="ville" class="form-label">Ville</label>
            <select class="form-select form-select-lg" name="villeDept" id="villeDept">
            <option value="<?php echo htmlspecialchars($userInfo['id_ville'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($userInfo['nom_ville'], ENT_QUOTES, 'UTF-8'); ?> (<?php echo htmlspecialchars($userInfo['code_postal'], ENT_QUOTES, 'UTF-8'); ?>)</option>
                <option value="">Selectionnez d'abord un département</option>

            </select>

            <label for="role" class="form-label">Role</label>
            <select class="form-select form-select-lg" name="role" id="role">

                <?php foreach ($roles as $role) { ?>
                    <option value="<?php echo htmlspecialchars($role['id_role'], ENT_QUOTES, 'UTF-8'); ?>" <?php if($userInfo['id_role'] == $role['id_role']){ echo 'selected'; } ?>><?php echo htmlspecialchars($role['nom_role'], ENT_QUOTES, 'UTF-8'); ?></option>
                <?php }; ?>

            </select>

            <input class="my-4 p-3  bg-db text-white border-0 mx-auto" type="submit" value="Modifier" name="add">

            <a href="../public/index.php?page=2" class="d-block">Annuler</a>

        </form>

    </section>
</main>