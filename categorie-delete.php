<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:categorie-index.php');
    die();
}
require_once('Classe/Categorie.php');

$categorie = new Categorie;
try{
    $categorie->delete('categorie', $_POST['id']);
    header('location:categorie-index.php');
}catch(PDOException $e){
    // ON DELETE RESTRICT : la catégorie contient encore des voitures
    header('location:categorie-index.php?erreur=categorie-pleine');
}
