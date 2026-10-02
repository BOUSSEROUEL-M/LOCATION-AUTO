<?php
require_once('Classe/Voiture.php');
require_once('inc/fonctions.php');

$voiture = new Voiture;
$voitures = $voiture->selectAvecCategorie();

$titre = 'Voitures';
$page = 'voitures';
require_once('inc/header.php');
?>
<div class="entete-page">
    <h1>Flotte</h1>
    <a class="btn" href="voiture-create.php">Ajouter une voiture</a>
</div>
<div class="tableau">
<table>
    <thead>
        <tr><th>Plaque</th><th>Voiture</th><th>Année</th><th>Catégorie</th><th class="num">Prix / jour</th><th></th></tr>
    </thead>
    <tbody>
    <?php foreach($voitures as $v){ ?>
        <tr>
            <td><span class="plaque"><?= e($v['plaque']) ?></span></td>
            <td><a href="voiture-show.php?id=<?= $v['id'] ?>"><?= e($v['marque'].' '.$v['modele']) ?></a></td>
            <td><?= $v['annee'] ?></td>
            <td><?= e($v['categorie']) ?></td>
            <td class="num"><?= argent($v['prix_jour']) ?></td>
            <td class="actions-ligne"><a href="voiture-show.php?id=<?= $v['id'] ?>">Voir</a> <a href="voiture-edit.php?id=<?= $v['id'] ?>">Modifier</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
<?php require_once('inc/footer.php'); ?>
