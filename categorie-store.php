<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:categorie-index.php');
    die();
}
require_once('Classe/Categorie.php');

$categorie = new Categorie;
try{
    $categorie->insert('categorie', $_POST);
    header('location:categorie-index.php');
}catch(PDOException $e){
    header('location:categorie-create.php?erreur=doublon');
}
