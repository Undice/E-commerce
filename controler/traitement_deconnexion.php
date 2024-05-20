<?php
session_start();
$idPanier = -1;
//permet de savoir s'il y a un panier en cours
// Si pas de panier la valeur de idPanier est négative
if(isset($_SESSION['idPanier'])){
    $idPanier = $_SESSION['idPanier'];
}
session_destroy();
session_start();
// Si la valeur de idPanier n'est pas négative alors recreer la sessions
// En mettant une valeur négative par défaut on s'assure que si l'idPanier est négatif, il ne tombera jamais sur l'idPanier existant
if($idPanier != -1){
    $_SESSION['idPanier'] =  $idPanier;
}

header('Location:../public/index.php?');
?>