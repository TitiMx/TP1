<?php

class Client {
    private $conn;
    private $table = 'Clients';

    public $client_id;
    public $nom;
    public $prenom;
    public $email;
    public $mot_de_passe;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function lire() {
        $query = 'SELECT client_id, nom, prénom, email FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function ajouter() {
        $query = 'INSERT INTO ' . $this->table . ' (nom, prénom, email, mot_de_passe) VALUES (?, ?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->nom, $this->prénom, $this->email, password_hash($this->mot_de_passe, PASSWORD_DEFAULT)]);
    }

    public function mettre_a_jour() {
        $query = 'UPDATE ' . $this->table . ' SET nom = ?, prénom = ?, email = ?, mot_de_passe = ? WHERE client_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $this->nom,
            $this->prénom,
            $this->email,
            password_hash($this->mot_de_passe, PASSWORD_DEFAULT),
            $this->client_id
        ]);
    }

    public function supprimer() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE client_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->client_id]);
    }
}
