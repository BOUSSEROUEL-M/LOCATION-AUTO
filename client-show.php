<?php
if(!isset($_GET['id']) or $_GET['id'] == null){
    header('location:client-index.php');
    die();
}
require_once('Classe/Client.php');
require_once('inc/fonctions.php');

$client = new Client;
$c = $client->selectId('client', $_GET['id']);
if(!$c){
    header('location:client-index.php');
    die();
}
// Relation 1-N : les locations de ce client
$locations = $client->selectLocations($c['id']);

$titre = $c['prenom'].' '.$c['nom'];
$page = 'clients';
require_once('inc/header.php');
?>
<div class="fiche">
    <h1><?= e($c['prenom'].' '.$c['nom']) ?></h1>
    <dl>
        <dt>Courriel</dt><dd><?= e($c['courriel']) ?></dd>
        <dt>Téléphone</dt><dd><?= e($c['telephone']) ?></dd>
    </dl>

    <h2>Locations</h2>
    <?php if(!$locations){ ?>
        <p class="vide">Aucune location pour ce client.</p>
    <?php }else{ ?>
        <ul>
        <?php foreach($locations as $l){ ?>
            <li><a href="location-show.php?id=<?= $l['id'] ?>">Du <?= $l['date_debut'] ?> au <?= $l['date_fin'] ?></a></li>
        <?php } ?>
        </ul>
    <?php } ?>

    <div class="actions">
        <a href="client-edit.php?id=<?= $c['id'] ?>" class="btn">Modifier</a>
        <form action="client-delete.php" method="post" onsubmit="return confirm('Supprimer ce client et toutes ses locations ?')">
            <input type="hidden" name="id" value="<?= $c['id'] ?>">
            <input type="submit" value="Supprimer" class="btn btn--danger">
        </form>
        <a href="client-index.php" class="btn btn--sobre">Retour à la liste</a>
    </div>
</div>
<?php require_once('inc/footer.php'); ?>
