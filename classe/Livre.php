<?php

À
    
    
    class Livre {
        private $conn;
        private $table = 'Livres';
    
        public $livre_id;
        public $titre;
        public $auteur_id;
        public $prix;
        public $quantite_en_stock;
    
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
        $query = 'INSERT INTO ' . $this->table . ' (titre, auteur_id, prix, quantité_en_stock) VALUES (?, ?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->titre, $this->auteur_id, $this->prix, $this->quantité_en_stock]);
    }

    public function mettre_a_jour() {
        $query = 'UPDATE ' . $this->table . ' SET titre = ?, auteur_id = ?, prix = ?, quantité_en_stock = ? WHERE livre_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->titre, $this->auteur_id, $this->prix, $this->quantité_en_stock, $this->livre_id]);
    }

    public function supprimer() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE livre_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->livre_id]);
    }
}
