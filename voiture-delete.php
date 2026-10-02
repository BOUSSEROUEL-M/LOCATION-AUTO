<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:voiture-index.php');
    die();
}
require_once('Classe/Voiture.php');

$id = $_POST['id'];
$voiture = new Voiture;

try{
    $voiture->delete('voiture', $id);
    header('location:voiture-index.php');
}catch(PDOException $e){
    // La clé étrangère de location_voiture empêche la suppression
    header("location:voiture-show.php?id=$id&erreur=voiture-louee");
}
