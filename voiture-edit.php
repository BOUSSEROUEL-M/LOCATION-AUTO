<?php
if(!isset($_GET['id']) or $_GET['id'] == null){
    header('location:voiture-index.php');
    die();
}
require_once('Classe/Voiture.php');
require_once('Classe/Categorie.php');
require_once('inc/fonctions.php');

$voiture = new Voiture;
$v = $voiture->selectId('voiture', $_GET['id']);
if(!$v){
    header('location:voiture-index.php');
    die();
}
$categorie = new Categorie;
$categories = $categorie->select('categorie', 'nom');

$titre = 'Modifier une voiture';
$page = 'voitures';
require_once('inc/header.php');
?>
<form action="voiture-update.php" method="post" class="formulaire">
    <h1>Modifier une voiture</h1>
    <input type="hidden" name="id" value="<?= $v['id'] ?>">
    <?php require('inc/form-voiture.php'); ?>
    <div class="actions">
        <input type="submit" class="btn" value="Enregistrer">
        <a href="voiture-show.php?id=<?= $v['id'] ?>" class="btn btn--sobre">Annuler</a>
    </div>
</form>
<?php require_once('inc/footer.php'); ?>
