<?php
require_once('Classe/Client.php');
require_once('inc/fonctions.php');

$client = new Client;
$clients = $client->select('client', 'nom');

$titre = 'Clients';
$page = 'clients';
require_once('inc/header.php');
?>
<div class="entete-page">
    <h1>Clients</h1>
    <a class="btn" href="client-create.php">Ajouter un client</a>
</div>
<div class="tableau">
<table>
    <thead><tr><th>Nom</th><th>Courriel</th><th>Téléphone</th><th></th></tr></thead>
    <tbody>
    <?php foreach($clients as $c){ ?>
        <tr>
            <td><a href="client-show.php?id=<?= $c['id'] ?>"><?= e($c['prenom'].' '.$c['nom']) ?></a></td>
            <td><?= e($c['courriel']) ?></td>
            <td><?= e($c['telephone']) ?></td>
            <td class="actions-ligne"><a href="client-show.php?id=<?= $c['id'] ?>">Voir</a> <a href="client-edit.php?id=<?= $c['id'] ?>">Modifier</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
<?php require_once('inc/footer.php'); ?>
