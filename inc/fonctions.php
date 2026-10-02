<?php
/** Affiche un texte sans risque dans le HTML. */
function e($valeur):string{
    return htmlspecialchars((string) $valeur, ENT_QUOTES, 'UTF-8');
}

/** Formate un montant en dollars. */
function argent($montant):string{
    return number_format((float) $montant, 2, ',', ' ').' $';
}
