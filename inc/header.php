<?php
// Variables attendues : $titre et $page (lien actif du menu)
$liens = [
    'accueil'    => ['index.php', 'Accueil'],
    'voitures'   => ['voiture-index.php', 'Voitures'],
    'categories' => ['categorie-index.php', 'Catégories'],
    'clients'    => ['client-index.php', 'Clients'],
    'locations'  => ['location-index.php', 'Locations'],
];
// Messages d'erreur envoyés dans l'URL (?erreur=...)
$erreurs = [
    'voiture-louee'     => 'Cette voiture fait partie d\'une location. Supprimez la location d\'abord.',
    'categorie-pleine'  => 'Cette catégorie contient encore des voitures. Déplacez-les ou supprimez-les d\'abord.',
    'doublon'           => 'Cette valeur existe déjà (plaque, courriel ou nom de catégorie).',
    'aucune-voiture'    => 'Choisissez au moins une voiture pour la location.',
    'dates'             => 'La date de fin doit être après la date de début.',
];
$erreur = $erreurs[$_GET['erreur'] ?? ''] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?> | Pie-IX Location</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="route">
    <div class="route__contenu">
        <a class="logo" href="index.php">Pie-IX <span>Location</span></a>
        <nav>
            <ul>
                <?php foreach($liens as $cle => $lien){ ?>
                    <li><a href="<?= $lien[0] ?>" <?= $cle == $page ? 'aria-current="page"' : '' ?>><?= $lien[1] ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>
<main>
<?php if($erreur){ ?>
    <p class="flash flash--erreur"><?= $erreur ?></p>
<?php } ?>
