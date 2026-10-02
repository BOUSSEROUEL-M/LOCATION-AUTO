<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:location-index.php');
    die();
}
require_once('Classe/Location.php');

$id = (int) $_POST['id'];
if(empty($_POST['voitures'])){
    header("location:location-edit.php?id=$id&erreur=aucune-voiture");
    die();
}
if($_POST['date_fin'] < $_POST['date_debut']){
    header("location:location-edit.php?id=$id&erreur=dates");
    die();
}

$location = new Location;
$location->beginTransaction();
$location->update('location', $_POST);
$location->retirerVoitures($id);
$location->ajouterVoitures($id, $_POST['voitures']);
$location->commit();

header("location:location-show.php?id=$id");
