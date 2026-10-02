<?php
if(!isset($_GET['id']) or $_GET['id'] == null){
    header('location:voiture-index.php');
    die();
}
require_once('Classe/Voiture.php');
require_once('inc/fonctions.php');

$voiture = new Voiture;
$v = $voiture->selectIdAvecCategorie((int) $_GET['id']);
if(!$v){
    header('location:voiture-index.php');
    die();
}

$titre = $v['marque'].' '.$v['modele'];
$page = 'voitures';
require_once('inc/header.php');
?>
<div class="fiche">
    <h1><?= e($v['marque'].' '.$v['modele']) ?></h1>
    <p><span class="plaque"><?= e($v['plaque']) ?></span></p>
    <dl>
        <dt>Année</dt><dd><?= $v['annee'] ?></dd>
        <dt>Catégorie</dt><dd><?= e($v['categorie']) ?></dd>
        <dt>Prix par jour</dt><dd><?= argent($v['prix_jour']) ?></dd>
    </dl>
    <div class="actions">
        <a href="voiture-edit.php?id=<?= $v['id'] ?>" class="btn">Modifier</a>
        <form action="voiture-delete.php" method="post" onsubmit="return confirm('Supprimer cette voiture ?')">
            <input type="hidden" name="id" value="<?= $v['id'] ?>">
            <input type="submit" value="Supprimer" class="btn btn--danger">
        </form>
        <a href="voiture-index.php" class="btn btn--sobre">Retour à la liste</a>
    </div>
</div>
<?php require_once('inc/footer.php'); ?>
