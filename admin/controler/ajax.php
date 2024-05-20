<?php 
require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$idDept = $_GET['idDepartement'];
$villes = recupVille($pdo, $idDept);

echo json_encode($villes);
?>