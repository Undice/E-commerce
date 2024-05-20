<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$nomMateriau = $_POST['nomMateriau'];
$idMateriau = $_GET['idMateriau'];

updateMateriau($pdo, $nomMateriau, $idMateriau);

header('Location:../public/index.php?page=7');