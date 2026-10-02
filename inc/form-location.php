<?php // Champs communs à location-create.php et location-edit.php ($l, $clients, $voitures, $choisies) ?>
<div class="champ">
    <label for="client_id">Client</label>
    <select id="client_id" name="client_id" required>
        <option value="">Choisir…</option>
        <?php foreach($clients as $client){ ?>
            <option value="<?= $client['id'] ?>" <?= $client['id'] == $l['client_id'] ? 'selected' : '' ?>><?= e($client['nom'].', '.$client['prenom']) ?></option>
        <?php } ?>
    </select>
</div>
<div class="dates">
    <div class="champ">
        <label for="date_debut">Début</label>
        <input id="date_debut" name="date_debut" type="date" value="<?= $l['date_debut'] ?>" required>
    </div>
    <div class="champ">
        <label for="date_fin">Fin</label>
        <input id="date_fin" name="date_fin" type="date" value="<?= $l['date_fin'] ?>" required>
    </div>
</div>
<fieldset class="champ">
    <legend>Voitures</legend>
    <div class="choix-voitures">
        <?php foreach($voitures as $v){ ?>
            <label class="choix">
                <input type="checkbox" name="voitures[]" value="<?= $v['id'] ?>" <?= in_array($v['id'], $choisies) ? 'checked' : '' ?>>
                <span class="plaque"><?= e($v['plaque']) ?></span>
                <span><?= e($v['marque'].' '.$v['modele']) ?><small><?= e($v['categorie']) ?>, <?= argent($v['prix_jour']) ?> / jour</small></span>
            </label>
        <?php } ?>
    </div>
</fieldset>
