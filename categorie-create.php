<?php
require_once('inc/fonctions.php');
$titre = 'Ajouter une catégorie';
$page = 'categories';
require_once('inc/header.php');
?>
<form action="categorie-store.php" method="post" class="formulaire">
    <h1>Ajouter une catégorie</h1>
    <div class="champ">
        <label for="nom">Nom</label>
        <input id="nom" name="nom" required>
    </div>
    <div class="champ">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3"></textarea>
    </div>
    <div class="actions">
        <input type="submit" class="btn" value="Ajouter la catégorie">
        <a href="categorie-index.php" class="btn btn--sobre">Annuler</a>
    </div>
</form>
<?php require_once('inc/footer.php'); ?>
