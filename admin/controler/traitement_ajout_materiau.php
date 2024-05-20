<?php

require "../../modele/connexionbdd.php";
require "../modele/fonctions.php";

$nomMateriau = $_POST['nomMateriau'];


//verifMateriauExiste($pdo) ?;

insertMateriau($pdo, $nomMateriau);

header('Location:../public/index.php?page=7');