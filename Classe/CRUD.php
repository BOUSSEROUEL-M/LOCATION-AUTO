<?php
/**
 * Classe CRUD : connexion à la base (hérite de PDO) + méthodes génériques
 * select, selectId, insert, update et delete utilisées par toutes les entités.
 */
class CRUD extends PDO {

    // Colonnes permises pour insert/update (définies dans les classes enfants)
    protected array $fillable = [];

    public function __construct(){
        // Connexion PDO réutilisable : à adapter selon l'hébergeur (WebDev, etc.)
        parent::__construct('mysql:host=localhost; dbname=location_auto; port=3306; charset=utf8mb4', 'root', '');
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * Retourne toutes les lignes d'une table, triées.
     */
    public function select(string $table, $field = "id", $order = "ASC"):array{
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Retourne une seule ligne selon sa valeur (id par défaut), ou false.
     */
    public function selectId(string $table, int|string $value, $field = 'id'):bool|array{
        $sql = "SELECT * FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return $stmt->fetch();
        }
        return false;
    }

    /**
     * Ajoute une ligne et retourne son id (ou false).
     */
    public function insert(string $table, array $data):bool|int{
        $data = $this->filtrer($data);
        $fieldName = implode(', ', array_keys($data));
        $fieldBindValue = ":".implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($fieldName) VALUES ($fieldBindValue);";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()){
            return (int) $this->lastInsertId();
        }
        return false;
    }

    /**
     * Modifie une ligne. $data doit contenir l'id.
     */
    public function update(string $table, array $data, $field = 'id'):bool{
        $id = $data[$field];
        $data = $this->filtrer($data);
        $fieldName = null;
        foreach($data as $key=>$value){
            $fieldName .= "$key = :$key, ";
        }
        $fieldName = rtrim($fieldName, ', ');
        $sql = "UPDATE $table SET $fieldName WHERE $field = :$field;";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":$field", $id);
        return $stmt->execute();
    }

    /**
     * Supprime une ligne.
     */
    public function delete(string $table, int|string $value, $field = 'id'):bool{
        $sql = "DELETE FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        return $stmt->execute();
    }

    /**
     * Garde seulement les colonnes permises ($fillable) du formulaire.
     */
    protected function filtrer(array $data):array{
        if(empty($this->fillable)){
            return $data;
        }
        return array_intersect_key($data, array_flip($this->fillable));
    }
}
