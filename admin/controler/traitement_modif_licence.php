<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$idLicence = $_GET['idLicence'];

$nomLicence = $_POST['nomLicence'];
$idCateg = $_POST['categ'];

updateLicence($pdo, $nomLicence, $idCateg, $idLicence);

header('Location:../public/index.php?page=4');