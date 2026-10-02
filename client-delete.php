<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:client-index.php');
    die();
}
require_once('Classe/Client.php');

// ON DELETE CASCADE : les locations du client sont supprimées aussi
$client = new Client;
$client->delete('client', $_POST['id']);
header('location:client-index.php');
