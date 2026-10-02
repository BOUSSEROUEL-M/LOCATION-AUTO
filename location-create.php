<?php
require_once('Classe/Client.php');
require_once('Classe/Voiture.php');
require_once('inc/fonctions.php');

$clients = (new Client)->select('client', 'nom');
$voitures = (new Voiture)->selectAvecCategorie();
$l = ['client_id' => '', 'date_debut' => date('Y-m-d'), 'date_fin' => date('Y-m-d', strtotime('+3 days'))];
$choisies = [];

$titre = 'Nouvelle location';
$page = 'locations';
require_once('inc/header.php');
?>
<form action="location-store.php" method="post" class="formulaire">
    <h1>Nouvelle location</h1>
    <?php require('inc/form-location.php'); ?>
    <div class="actions">
        <input type="submit" class="btn" value="Créer la location">
        <a href="location-index.php" class="btn btn--sobre">Annuler</a>
    </div>
</form>
<?php require_once('inc/footer.php'); ?>
