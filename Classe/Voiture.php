<?php
require_once(__DIR__.'/CRUD.php');

/**
 * Voiture de la flotte. Chaque voiture appartient à une catégorie (clé étrangère).
 */
class Voiture extends CRUD {

    public string $table = 'voiture';
    protected array $fillable = ['marque', 'modele', 'annee', 'plaque', 'prix_jour', 'categorie_id'];

    /**
     * Toutes les voitures avec le nom de leur catégorie (jointure).
     */
    public function selectAvecCategorie():array{
        $sql = "SELECT v.*, c.nom AS categorie
                FROM voiture v
                JOIN categorie c ON c.id = v.categorie_id
                ORDER BY v.marque, v.modele";
        return $this->query($sql)->fetchAll();
    }

    /**
     * Une voiture avec le nom de sa catégorie, ou false.
     */
    public function selectIdAvecCategorie(int $id):bool|array{
        $sql = "SELECT v.*, c.nom AS categorie
                FROM voiture v
                JOIN categorie c ON c.id = v.categorie_id
                WHERE v.id = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
