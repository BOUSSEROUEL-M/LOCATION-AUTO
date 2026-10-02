<?php
require_once('inc/fonctions.php');
$c = ['prenom' => '', 'nom' => '', 'courriel' => '', 'telephone' => ''];

$titre = 'Ajouter un client';
$page = 'clients';
require_once('inc/header.php');
?>
<form action="client-store.php" method="post" class="formulaire">
    <h1>Ajouter un client</h1>
    <?php require('inc/form-client.php'); ?>
    <div class="actions">
        <input type="submit" class="btn" value="Ajouter le client">
        <a href="client-index.php" class="btn btn--sobre">Annuler</a>
    </div>
</form>
<?php require_once('inc/footer.php'); ?>
