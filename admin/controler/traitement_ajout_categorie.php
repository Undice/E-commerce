<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$nomCateg = $_POST['nomCateg'];


//verifCategExiste($pdo) ?;

insertCateg($pdo, $nomCateg);

header('Location:../public/index.php?page=5');