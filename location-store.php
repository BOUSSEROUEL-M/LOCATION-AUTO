<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:location-index.php');
    die();
}
require_once('Classe/Location.php');

if(empty($_POST['voitures'])){
    header('location:location-create.php?erreur=aucune-voiture');
    die();
}
if($_POST['date_fin'] < $_POST['date_debut']){
    header('location:location-create.php?erreur=dates');
    die();
}

$location = new Location;
// Transaction : la location et ses voitures sont enregistrées ensemble
$location->beginTransaction();
$insert = $location->insert('location', $_POST);
$location->ajouterVoitures($insert, $_POST['voitures']);
$location->commit();

header("location:location-show.php?id=$insert");
