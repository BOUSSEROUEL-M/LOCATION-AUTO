<?php
require_once('Classe/Location.php');
require_once('inc/fonctions.php');

$location = new Location;
$locations = $location->selectDetails();
$nbVoitures = count($location->select('voiture'));
$nbClients = count($location->select('client'));

$titre = 'Accueil';
$page = 'accueil';
require_once('inc/header.php');
?>
<section class="accueil">
    <h1>Le comptoir de location</h1>
    <p class="intro">Gérez la flotte, les clients et les réservations au même endroit.
        <?= $nbVoitures ?> voitures et <?= $nbClients ?> clients sont enregistrés.</p>
    <div class="actions">
        <a class="btn" href="location-create.php">Nouvelle location</a>
        <a class="btn btn--sobre" href="voiture-create.php">Ajouter une voiture</a>
    </div>
</section>

<section>
    <h2>Dernières locations</h2>
    <ul class="tickets">
        <?php foreach(array_slice($locations, 0, 4) as $l){ ?>
            <li class="ticket">
                <strong><a href="location-show.php?id=<?= $l['id'] ?>"><?= e($l['client']) ?></a></strong>
                <span><?= e($l['voitures']) ?></span>
                <span class="ticket__dates">du <?= $l['date_debut'] ?> au <?= $l['date_fin'] ?></span>
                <span class="ticket__total"><?= argent($l['total']) ?></span>
            </li>
        <?php } ?>
    </ul>
</section>
<?php require_once('inc/footer.php'); ?>
