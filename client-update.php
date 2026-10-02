<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:client-index.php');
    die();
}
require_once('Classe/Client.php');

$client = new Client;
try{
    $client->update('client', $_POST);
    header('location:client-show.php?id='.$_POST['id']);
}catch(PDOException $e){
    header('location:client-edit.php?id='.$_POST['id'].'&erreur=doublon');
}
