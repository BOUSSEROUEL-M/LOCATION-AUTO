<?php
require_once(__DIR__.'/CRUD.php');

/**
 * Catégorie de véhicule. Une catégorie regroupe plusieurs voitures (1-N).
 */
class Categorie extends CRUD {

    public string $table = 'categorie';
    protected array $fillable = ['nom', 'description'];

    /**
     * Toutes les catégories avec le nombre de voitures de chacune.
     */
    public function selectAvecNombre():array{
        $sql = "SELECT c.*, COUNT(v.id) AS nb_voitures
                FROM categorie c
                LEFT JOIN voiture v ON v.categorie_id = c.id
                GROUP BY c.id
                ORDER BY c.nom";
        return $this->query($sql)->fetchAll();
    }
}
