<?php
$username = 'root';
$mdp = '';
try {
    $pdo = new PDO('mysql:host=localhost;dbname=e-commerce',$username,$mdp);
}catch(PDOException $e) {
    echo $e->getMessage();
    die();
}
?>