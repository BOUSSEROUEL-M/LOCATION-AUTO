<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:voiture-index.php');
    die();
}
require_once('Classe/Voiture.php');

$voiture = new Voiture;
$_POST['plaque'] = strtoupper(trim($_POST['plaque']));

try{
    $voiture->update('voiture', $_POST);
    header('location:voiture-show.php?id='.$_POST['id']);
}catch(PDOException $e){
    header('location:voiture-edit.php?id='.$_POST['id'].'&erreur=doublon');
}
