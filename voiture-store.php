<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:voiture-index.php');
    die();
}
require_once('Classe/Voiture.php');

$voiture = new Voiture;
$_POST['plaque'] = strtoupper(trim($_POST['plaque']));

try{
    $insert = $voiture->insert('voiture', $_POST);
    header("location:voiture-show.php?id=$insert");
}catch(PDOException $e){
    header('location:voiture-create.php?erreur=doublon');
}
