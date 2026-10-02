<?php
require_once(__DIR__.'/CRUD.php');

/**
 * Client de l'agence. Un client peut faire plusieurs locations (1-N).
 */
class Client extends CRUD {

    public string $table = 'client';
    protected array $fillable = ['prenom', 'nom', 'courriel', 'telephone'];

    /**
     * Les locations d'un client (relation 1-N).
     */
    public function selectLocations(int $clientId):array{
        $sql = "SELECT * FROM location WHERE client_id = :id ORDER BY date_debut DESC";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $clientId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
