<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:categorie-index.php');
    die();
}
require_once('Classe/Categorie.php');

$categorie = new Categorie;
try{
    $categorie->update('categorie', $_POST);
    header('location:categorie-index.php');
}catch(PDOException $e){
    header('location:categorie-edit.php?id='.$_POST['id'].'&erreur=doublon');
}
