<?php
require_once('Classe/Categorie.php');
require_once('inc/fonctions.php');

$categorie = new Categorie;
$categories = $categorie->selectAvecNombre();

$titre = 'Catégories';
$page = 'categories';
require_once('inc/header.php');
?>
<div class="entete-page">
    <h1>Catégories</h1>
    <a class="btn" href="categorie-create.php">Ajouter une catégorie</a>
</div>
<div class="tableau">
<table>
    <thead><tr><th>Nom</th><th>Description</th><th class="num">Voitures</th><th></th></tr></thead>
    <tbody>
    <?php foreach($categories as $c){ ?>
        <tr>
            <td><?= e($c['nom']) ?></td>
            <td><?= e($c['description']) ?></td>
            <td class="num"><?= $c['nb_voitures'] ?></td>
            <td class="actions-ligne">
                <a href="categorie-edit.php?id=<?= $c['id'] ?>">Modifier</a>
                <form action="categorie-delete.php" method="post" onsubmit="return confirm('Supprimer cette catégorie ?')">
                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                    <button class="lien-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
<?php require_once('inc/footer.php'); ?>
