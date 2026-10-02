<?php // Champs communs à client-create.php et client-edit.php ($c = client) ?>
<div class="champ">
    <label for="prenom">Prénom</label>
    <input id="prenom" name="prenom" value="<?= e($c['prenom']) ?>" required>
</div>
<div class="champ">
    <label for="nom">Nom</label>
    <input id="nom" name="nom" value="<?= e($c['nom']) ?>" required>
</div>
<div class="champ">
    <label for="courriel">Courriel</label>
    <input id="courriel" name="courriel" type="email" value="<?= e($c['courriel']) ?>" required>
</div>
<div class="champ">
    <label for="telephone">Téléphone</label>
    <input id="telephone" name="telephone" type="tel" value="<?= e($c['telephone']) ?>">
</div>
