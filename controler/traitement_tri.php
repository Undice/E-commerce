<?php
session_start();

require('../modele/connexionBdd.php');
require('../modele/fonctions.php');

if(isset($_GET['tri'])){
   
    if($_GET['tri'] == 'croissant') {
        $_SESSION['tri'] = ' ORDER BY prix ASC';
    }
    if($_GET['tri'] == 'decroissant') {
        $_SESSION['tri'] = ' ORDER BY prix DESC';
    }
    if($_GET['tri'] == 'alphabetical') {
        $_SESSION['tri'] = ' ORDER BY nom_produit ASC';
    }
    if($_GET['tri'] == 'default') {
        unset($_SESSION['tri']);
    }
}
header('Location:../public/index.php?page=1');