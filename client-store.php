<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:client-index.php');
    die();
}
require_once('Classe/Client.php');

$client = new Client;
try{
    $insert = $client->insert('client', $_POST);
    header("location:client-show.php?id=$insert");
}catch(PDOException $e){
    header('location:client-create.php?erreur=doublon');
}
