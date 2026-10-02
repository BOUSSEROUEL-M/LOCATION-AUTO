<?php
require_once('Classe/Categorie.php');
require_once('inc/fonctions.php');

$categorie = new Categorie;
$categories = $categorie->select('categorie', 'nom');
$v = ['marque' => '', 'modele' => '', 'annee' => date('Y'), 'plaque' => '', 'prix_jour' => '', 'categorie_id' => ''];

$titre = 'Ajouter une voiture';
$page = 'voitures';
require_once('inc/header.php');
?>
<form action="voiture-store.php" method="post" class="formulaire">
    <h1>Ajouter une voiture</h1>
    <?php require('inc/form-voiture.php'); ?>
    <div class="actions">
        <input type="submit" class="btn" value="Ajouter la voiture">
        <a href="voiture-index.php" class="btn btn--sobre">Annuler</a>
    </div>
</form>
<?php require_once('inc/footer.php'); ?>
