<?php
if(!isset($_GET['id']) or $_GET['id'] == null){
    header('location:location-index.php');
    die();
}
require_once('Classe/Location.php');
require_once('Classe/Client.php');
require_once('inc/fonctions.php');

$location = new Location;
$l = $location->selectId('location', $_GET['id']);
if(!$l){
    header('location:location-index.php');
    die();
}
$client = (new Client)->selectId('client', $l['client_id']);
// Relation N-N : les voitures de cette location
$voitures = $location->selectVoitures($l['id']);
$jours = $location->nbJours($l['date_debut'], $l['date_fin']);
$total = array_sum(array_column($voitures, 'prix_jour')) * $jours;

$titre = 'Location';
$page = 'locations';
require_once('inc/header.php');
?>
<div class="fiche">
    <h1>Location de <?= e($client['prenom'].' '.$client['nom']) ?></h1>
    <dl>
        <dt>Période</dt><dd>Du <?= $l['date_debut'] ?> au <?= $l['date_fin'] ?> (<?= $jours ?> jours)</dd>
        <dt>Total</dt><dd><?= argent($total) ?></dd>
    </dl>
    <h2>Voitures</h2>
    <ul>
    <?php foreach($voitures as $v){ ?>
        <li><span class="plaque"><?= e($v['plaque']) ?></span> <?= e($v['marque'].' '.$v['modele']) ?>, <?= argent($v['prix_jour']) ?> / jour</li>
    <?php } ?>
    </ul>
    <div class="actions">
        <a href="location-edit.php?id=<?= $l['id'] ?>" class="btn">Modifier</a>
        <form action="location-delete.php" method="post" onsubmit="return confirm('Annuler cette location ?')">
            <input type="hidden" name="id" value="<?= $l['id'] ?>">
            <input type="submit" value="Annuler la location" class="btn btn--danger">
        </form>
        <a href="location-index.php" class="btn btn--sobre">Retour à la liste</a>
    </div>
</div>
<?php require_once('inc/footer.php'); ?>
