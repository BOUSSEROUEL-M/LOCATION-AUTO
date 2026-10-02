<?php
if(!isset($_GET['id']) or $_GET['id'] == null){
    header('location:categorie-index.php');
    die();
}
require_once('Classe/Categorie.php');
require_once('inc/fonctions.php');

$categorie = new Categorie;
$c = $categorie->selectId('categorie', $_GET['id']);
if(!$c){
    header('location:categorie-index.php');
    die();
}

$titre = 'Modifier une catégorie';
$page = 'categories';
require_once('inc/header.php');
?>
<form action="categorie-update.php" method="post" class="formulaire">
    <h1>Modifier une catégorie</h1>
    <input type="hidden" name="id" value="<?= $c['id'] ?>">
    <div class="champ">
        <label for="nom">Nom</label>
        <input id="nom" name="nom" value="<?= e($c['nom']) ?>" required>
    </div>
    <div class="champ">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3"><?= e($c['description']) ?></textarea>
    </div>
    <div class="actions">
        <input type="submit" class="btn" value="Enregistrer">
        <a href="categorie-index.php" class="btn btn--sobre">Annuler</a>
    </div>
</form>
<?php require_once('inc/footer.php'); ?>
