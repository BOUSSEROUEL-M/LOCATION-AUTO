<?php
if(!isset($_GET['id']) or $_GET['id'] == null){
    header('location:client-index.php');
    die();
}
require_once('Classe/Client.php');
require_once('inc/fonctions.php');

$client = new Client;
$c = $client->selectId('client', $_GET['id']);
if(!$c){
    header('location:client-index.php');
    die();
}

$titre = 'Modifier un client';
$page = 'clients';
require_once('inc/header.php');
?>
<form action="client-update.php" method="post" class="formulaire">
    <h1>Modifier un client</h1>
    <input type="hidden" name="id" value="<?= $c['id'] ?>">
    <?php require('inc/form-client.php'); ?>
    <div class="actions">
        <input type="submit" class="btn" value="Enregistrer">
        <a href="client-show.php?id=<?= $c['id'] ?>" class="btn btn--sobre">Annuler</a>
    </div>
</form>
<?php require_once('inc/footer.php'); ?>
