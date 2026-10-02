<?php // Champs communs à voiture-create.php et voiture-edit.php ($v = voiture, $categories) ?>
<div class="champ">
    <label for="marque">Marque</label>
    <input id="marque" name="marque" value="<?= e($v['marque']) ?>" required>
</div>
<div class="champ">
    <label for="modele">Modèle</label>
    <input id="modele" name="modele" value="<?= e($v['modele']) ?>" required>
</div>
<div class="champ">
    <label for="annee">Année</label>
    <input id="annee" name="annee" type="number" min="1990" max="<?= date('Y') + 1 ?>" value="<?= e($v['annee']) ?>" required>
</div>
<div class="champ">
    <label for="plaque">Plaque</label>
    <input id="plaque" name="plaque" maxlength="10" value="<?= e($v['plaque']) ?>" required>
</div>
<div class="champ">
    <label for="prix_jour">Prix par jour ($)</label>
    <input id="prix_jour" name="prix_jour" type="number" step="0.01" min="1" value="<?= e($v['prix_jour']) ?>" required>
</div>
<div class="champ">
    <label for="categorie_id">Catégorie</label>
    <select id="categorie_id" name="categorie_id" required>
        <option value="">Choisir…</option>
        <?php foreach($categories as $categorie){ ?>
            <option value="<?= $categorie['id'] ?>" <?= $categorie['id'] == $v['categorie_id'] ? 'selected' : '' ?>><?= e($categorie['nom']) ?></option>
        <?php } ?>
    </select>
</div>
