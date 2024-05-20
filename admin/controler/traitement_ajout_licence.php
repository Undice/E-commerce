<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$nomLicence = $_POST['nomLicence'];
$idCateg = $_POST['categorie'];

//verifLicenceExiste($pdo) ?;

insertLicence($pdo, $nomLicence, $idCateg);

header('Location:../public/index.php?page=4');