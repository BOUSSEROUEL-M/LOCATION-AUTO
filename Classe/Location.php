<?php
require_once(__DIR__.'/CRUD.php');

/**
 * Location d'un client. Une location contient une ou plusieurs voitures
 * (relation N-N via la table pivot location_voiture).
 */
class Location extends CRUD {

    public string $table = 'location';
    protected array $fillable = ['client_id', 'date_debut', 'date_fin'];

    /**
     * Toutes les locations avec le nom du client, les voitures et le total.
     */
    public function selectDetails():array{
        $sql = "SELECT l.*,
                       CONCAT(c.prenom, ' ', c.nom) AS client,
                       GROUP_CONCAT(CONCAT(v.marque, ' ', v.modele) SEPARATOR ', ') AS voitures,
                       SUM(v.prix_jour) * (DATEDIFF(l.date_fin, l.date_debut) + 1) AS total
                FROM location l
                JOIN client c ON c.id = l.client_id
                LEFT JOIN location_voiture lv ON lv.location_id = l.id
                LEFT JOIN voiture v ON v.id = lv.voiture_id
                GROUP BY l.id
                ORDER BY l.date_debut DESC";
        return $this->query($sql)->fetchAll();
    }

    /**
     * Les voitures d'une location.
     */
    public function selectVoitures(int $locationId):array{
        $sql = "SELECT v.* FROM voiture v
                JOIN location_voiture lv ON lv.voiture_id = v.id
                WHERE lv.location_id = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $locationId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Ajoute les voitures choisies dans la table pivot.
     */
    public function ajouterVoitures(int $locationId, array $voitures):void{
        $stmt = $this->prepare("INSERT INTO location_voiture (location_id, voiture_id) VALUES (:location, :voiture)");
        foreach(array_unique($voitures) as $voitureId){
            $stmt->bindValue(':location', $locationId);
            $stmt->bindValue(':voiture', (int) $voitureId);
            $stmt->execute();
        }
    }

    /**
     * Retire toutes les voitures d'une location (avant une modification).
     */
    public function retirerVoitures(int $locationId):void{
        $this->delete('location_voiture', $locationId, 'location_id');
    }

    /**
     * Nombre de jours d'une location (début et fin inclus).
     */
    public function nbJours(string $debut, string $fin):int{
        return (new DateTime($debut))->diff(new DateTime($fin))->days + 1;
    }
}
