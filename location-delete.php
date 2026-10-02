<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:location-index.php');
    die();
}
require_once('Classe/Location.php');

// ON DELETE CASCADE : les lignes de location_voiture sont supprimées aussi
$location = new Location;
$location->delete('location', $_POST['id']);
header('location:location-index.php');
