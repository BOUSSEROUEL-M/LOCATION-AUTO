<?php
if(!isset($_GET['id']) or $_GET['id'] == null){
    header('location:location-index.php');
    die();
}
require_once('Classe/Location.php');
require_once('Classe/Client.php');
require_once('Classe/Voiture.php');
require_once('inc/fonctions.php');

$location = new Location;
$l = $location->selectId('location', $_GET['id']);
if(!$l){
    header('location:location-index.php');
    die();
}
$choisies = array_column($location->selectVoitures($l['id']), 'id');
$clients = (new Client)->select('client', 'nom');
$voitures = (new Voiture)->selectAvecCategorie();

$titre = 'Modifier une location';
$page = 'locations';
require_once('inc/header.php');
?>
<form action="location-update.php" method="post" class="formulaire">
    <h1>Modifier une location</h1>
    <input type="hidden" name="id" value="<?= $l['id'] ?>">
    <?php require('inc/form-location.php'); ?>
    <div class="actions">
        <input type="submit" class="btn" value="Enregistrer">
        <a href="location-show.php?id=<?= $l['id'] ?>" class="btn btn--sobre">Annuler</a>
    </div>
</form>
<?php require_once('inc/footer.php'); ?>
