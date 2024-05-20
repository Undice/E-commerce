<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <title>Admin Kappy</title>
</head>

<body>
    <?php
    session_start();
    require "../../modele/connexionbdd.php";
    require "../modele/fonctions.php";
    // include "../vue/header.php";


    if (isset($_SESSION['idUser'])) {

        if ($_SESSION['idRoleUser'] == 2 || $_SESSION['idRoleUser'] == 3) {

    ?>
            <div class="container-fluid">

                <div class="row">
                    <div class="col-2 p-0">
                        <?php
                        include "../vue/admin.php";
                        ?>
                    </div>
                    <div class="col-10 p-0">
                        <?php
                        if (isset($_GET['page'])) {
                            if ($_GET['page'] == 1) {
                                include "../vue/accueil.php";
                            }
                            if ($_GET['page'] == 2) {
                                include "../vue/users.php";
                            }
                            if ($_GET['page'] == 3) {
                                include "../vue/produits.php";
                            }
                            if ($_GET['page'] == 4) {
                                include "../vue/licences.php";
                            }
                            if ($_GET['page'] == 5) {
                                include "../vue/categories.php";
                            }
                            if ($_GET['page'] == 6) {
                                include "../vue/marques.php";
                            }
                            if ($_GET['page'] == 7) {
                                include "../vue/materiaux.php";
                            }
                            if ($_GET['page'] == 8) {
                                include "../vue/modifUser.php";
                            }
                            if ($_GET['page'] == 9) {
                                include "../vue/modifProduit.php";
                            }
                            if ($_GET['page'] == 10) {
                                include "../vue/modifLicence.php";
                            }
                            if ($_GET['page'] == 11) {
                                include "../vue/modifCateg.php";
                            }
                            if ($_GET['page'] == 12) {
                                include "../vue/modifMarque.php";
                            }
                            if ($_GET['page'] == 13) {
                                include "../vue/modifMateriau.php";
                            }
                            if ($_GET['page'] == 14) {
                                include "../vue/produitsCaches.php";
                            }
                            if ($_GET['page'] == 15) {
                                include "../vue/bons.php";
                            }
                            if ($_GET['page'] == 16) {
                                include "../vue/modifBon.php";
                            }
                            // if ($_GET['page'] == 17) {

                            // }
                        } else {
                            include "../vue/accueil.php";
                        }
                        ?>
                    </div>
                </div>

            </div>
    <?php
        } else {
            include "../vue/connexion.php";
        }
    } else {
        include "../vue/connexion.php";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f718564d15.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"> </script>
</body>

</html>