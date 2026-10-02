<?php
require_once('Classe/Location.php');
require_once('inc/fonctions.php');

$location = new Location;
$locations = $location->selectDetails();

$titre = 'Locations';
$page = 'locations';
require_once('inc/header.php');
?>
<div class="entete-page">
    <h1>Locations</h1>
    <a class="btn" href="location-create.php">Nouvelle location</a>
</div>
<div class="tableau">
<table>
    <thead><tr><th>Client</th><th>Voitures</th><th>Du</th><th>Au</th><th class="num">Total</th><th></th></tr></thead>
    <tbody>
    <?php foreach($locations as $l){ ?>
        <tr>
            <td><?= e($l['client']) ?></td>
            <td><?= e($l['voitures']) ?></td>
            <td><?= $l['date_debut'] ?></td>
            <td><?= $l['date_fin'] ?></td>
            <td class="num"><?= argent($l['total']) ?></td>
            <td class="actions-ligne"><a href="location-show.php?id=<?= $l['id'] ?>">Voir</a> <a href="location-edit.php?id=<?= $l['id'] ?>">Modifier</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
<?php require_once('inc/footer.php'); ?>
