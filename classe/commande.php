<?php


class Commande {
    private $conn;
    private $table = 'Commandes';

    public $commande_id;
    public $client_id;
    public $livre_id;
    public $quantite;
    public $date_de_commande;

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
        $query = 'INSERT INTO ' . $this->table . ' (client_id, livre_id, quantité, date_de_commande) VALUES (?, ?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->client_id, $this->livre_id, $this->quantité, $this->date_de_commande]);
    }

    public function mettre_a_jour() {
        $query = 'UPDATE ' . $this->table . ' SET client_id = ?, livre_id = ?, quantité = ?, date_de_commande = ? WHERE commande_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $this->client_id,
            $this->livre_id,
            $this->quantite,
            $this->date_de_commande,
            $this->commande_id
        ]);
    }

    public function supprimer() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE commande_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->commande_id]);
    } 
} 