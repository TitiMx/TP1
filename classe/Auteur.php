<?php

class Auteur {
    private $conn;
    private $table = 'Auteurs';

    public $auteur_id;
    public $nom;
    public $prenom;
    public $date_naissance;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function lire() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function ajouter() {
        $query = 'INSERT INTO ' . $this->table . ' (nom, prenom, date_naissance) VALUES (?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->nom, $this->prenom, $this->date_naissance]);
    }

    public function mettre_a_jour() {
        $query = 'UPDATE ' . $this->table . ' SET nom = ?, prenom = ?, date_naissance = ? WHERE auteur_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->nom, $this->prenom, $this->date_naissance, $this->auteur_id]);
    }

    public function supprimer() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE auteur_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->auteur_id]);
    }
}
