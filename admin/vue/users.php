<?php

$users = recupUsers($pdo);
$departements = recupDepartements($pdo);
$roles = recupRoles($pdo);
date_default_timezone_set('Europe/Paris');

?>

<main class="users">
    <section>
        <h1 class="py-5 text-center">Utilisateurs</h1>
        <?php
        if (isset($_GET['clic'])) {
            if ($_GET['clic'] == 'ajouter') {
        ?>
                <form class="text-center color-snowy" method="post" action="../controler/traitement_ajout_user.php">
                    <div class="d-md-flex justify-content-center align-items-center mb-4 py-2">

                        <div class="form-check form-check-inline mx-4 my-2">
                            <input class="form-check-input" type="radio" name="sexe" id="femme" value="femme" />
                            <label class="form-check-label" for="sexe">Femme</label>
                        </div>

                        <div class="form-check form-check-inline mx-4 my-2">
                            <input class="form-check-input" type="radio" name="sexe" id="homme" value="homme" />
                            <label class="form-check-label" for="sexe">Homme</label>
                        </div>

                        <div class="form-check form-check-inline mx-4 my-2">
                            <input class="form-check-input" type="radio" name="sexe" id="autre" value="autre" />

                            <label class="form-check-label" for="sexe">Autre</label>
                        </div>

                    </div>

                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control form-control-lg" id="prenom" name="prenom" value="">

                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control form-control-lg" id="nom" name="nom" value="">

                    <label for="tel" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control form-control-lg" id="tel" name="tel" value="">

                    <label for="anniversaire" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control form-control-lg" id="anniversaire" name="anniversaire" value="" max="<?php echo date('Y-m-d'); ?>">

                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email" value="">

                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control form-control-lg" id="address" name="address" value="">

                    <label for="dept" class="form-label">Département</label>
                    <select class="form-select form-select-lg" id="dept" name="dept">

                        <?php foreach ($departements as $departement) { ?>
                            <option value="<?php echo htmlspecialchars($departement['id_departement'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($departement['numero'], ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($departement['nom_departement'], ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php }; ?>

                    </select>

                    <label for="ville" class="form-label">Ville</label>
                    <select class="form-select form-select-lg" id="villeDept" name="villeDept">

                        <option value="">Selectionnez d'abord un département</option>

                    </select>

                    <label for="role" class="form-label">Role</label>
                    <select class="form-select form-select-lg" name="role" id="role">

                        <?php foreach ($roles as $role) { ?>
                            <option value="<?php echo htmlspecialchars($role['id_role'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($role['nom_role'], ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php }; ?>

                    </select>

                    <input class="my-4 p-3 bg-sand color-snowy border-0 mx-auto" type="submit" value="Ajouter" name="add">

                    <a href="../public/index.php?page=1" class="d-block">Annuler</a>

                </form>

            <?php
            }
        } else {
            ?>
            <a href="../public/index.php?page=2&clic=ajouter">Ajouter un utilisateur</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rôle</th>
                        <th scope="col" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($user['id_user'], ENT_QUOTES, 'UTF-8'); ?></th>
                            <td><?php echo htmlspecialchars($user['prenom'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user['nom_user'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user['nom_role'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-eye"></i></button></td>
                            <td><a href="index.php?page=8&idUser=<?php echo htmlspecialchars($user['id_user'], ENT_QUOTES, 'UTF-8'); ?>" class="text-black text-decoration-none">Edit</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } ?>

        <!-- Modale  -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>