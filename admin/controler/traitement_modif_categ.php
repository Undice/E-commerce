<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$nomCateg = $_POST['nomCateg'];
$idCateg = $_GET['idCateg'];

updateCateg($pdo, $nomCateg, $idCateg);

header('Location:../public/index.php?page=5');