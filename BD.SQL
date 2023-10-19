
--  Auteurs
CREATE TABLE Auteurs (
    auteur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_de_naissance DATE
);

--  Clients
CREATE TABLE Clients (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL
);

--  Livres
CREATE TABLE Livres (
    livre_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur_id INT,
    prix DECIMAL(10, 2) NOT NULL,
    quantité_en_stock INT NOT NULL DEFAULT 0,
    FOREIGN KEY (auteur_id) REFERENCES Auteurs(auteur_id)
);

--  Commandes
CREATE TABLE Commandes (
    commande_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    livre_id INT,
    quantité INT NOT NULL DEFAULT 1,
    date_de_commande DATE NOT NULL DEFAULT CURRENT_DATE,
    FOREIGN KEY (client_id) REFERENCES Clients(client_id),
    FOREIGN KEY (livre_id) REFERENCES Livres(livre_id)
);


INSERT INTO Auteurs (nom, prenom, date_de_naissance) VALUES ('Martin', 'Paul', '1980-05-23');
INSERT INTO Auteurs (nom, prenom, date_de_naissance) VALUES ('Durand', 'Sophie', '1975-03-18');
INSERT INTO Clients (nom, prenom, email, mot_de_passe) VALUES ('Dupont', 'Marc', 'marc.dupont@email.com', 'motdepassemarc');
INSERT INTO Clients (nom, prenom, email, mot_de_passe) VALUES ('Leroy', 'Alice', 'alice.leroy@email.com', 'motdepassealice');
INSERT INTO Livres (titre, auteur_id, prix, quantité_en_stock) VALUES ('Le grand voyage', 1, 15.99, 20);
INSERT INTO Livres (titre, auteur_id, prix, quantité_en_stock) VALUES ('La montagne secrète', 2, 20.49, 15);
INSERT INTO Commandes (client_id, livre_id, quantité) VALUES (1, 1, 2);
INSERT INTO Commandes (client_id, livre_id, quantité) VALUES (2, 2, 1);
