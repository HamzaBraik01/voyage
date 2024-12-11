
CREATE DATABASE voyage1;

USE voyage1;


CREATE TABLE client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    telephone VARCHAR(15),
    adresse TEXT,
    date_naissance DATE
);


CREATE TABLE activite (
    id_activite INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150),
    description TEXT,
    destination VARCHAR(100),
    prix DECIMAL(10, 2) NOT NULL,
    date_debut DATE,
    date_fin DATE,
    places_disponsibles INT NOT NULL
);


CREATE TABLE reservation (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    id_activite INT,
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('EN attente', 'Confirmée', 'Annulée'),
    FOREIGN KEY (id_client) REFERENCES client (id_client) ON DELETE CASCADE ,
    FOREIGN KEY (id_activite) REFERENCES activite (id_activite) 
);


INSERT INTO client (nom, prenom, email, telephone, adresse, date_naissance)
VALUES 
('El Amrani', 'Ahmed', 'ahmed.elamrani@example.com', '0612345678', '123 rue Mohammed V, Casablanca', '1985-02-15'),
('Benkirane', 'Fatima', 'fatima.benkirane@example.com', '0698765432', '456 avenue Al Qods, Rabat', '1990-07-22'),
('Mouhib', 'Youssef', 'youssef.mouhib@example.com', '0623456789', '789 boulevard Hassan II, Marrakech', '1983-11-30'),
('El Fassi', 'Samira', 'samira.elfassi@example.com', '0654321098', '321 rue des Oliviers, Fès', '1995-03-11'),
('Ait Lahcen', 'Mohammed', 'mohammed.aitlahcen@example.com', '0687654321', '654 impasse des Jardins, Agadir', '1992-06-25'),
('El Hamrei', 'aida', 'aida.elfassi@example.com', '0685321098', '321 rue des Oliviers, Safi', '1995-03-11');


INSERT INTO activite (titre, description, destination, prix, date_debut, date_fin, places_disponsibles)
VALUES 
('Croisière sur le fleuve Bouregreg', 'Croisière relaxante sur le fleuve Bouregreg avec des vues magnifiques', 'Salé', 1200.00, '2024-06-01', '2024-06-15', 50),
('Randonnée dans le Haut Atlas', 'Randonnée guidée dans les montagnes du Haut Atlas', 'Toubkal', 300.00, '2024-07-10', '2024-07-20', 30),
('Séjour culturel à Marrakech', 'Visite des souks, des jardins et des monuments de Marrakech', 'Marrakech', 800.00, '2024-08-05', '2024-08-12', 40),
('Safari dans le parc national de Souss-Massa', 'Observation de la faune et découverte de la région', 'Souss-Massa', 2500.00, '2024-09-15', '2024-09-30', 20),
('Séjour bien-être à Essaouira', 'Séjour de relaxation et spa au bord de la mer', 'Essaouira', 1500.00, '2024-10-01', '2024-10-15', 25);


INSERT INTO reservation (id_client, id_activite, date_reservation, statut)
VALUES 
(1, 2, CURRENT_TIMESTAMP, 'EN attente'),
(2, 3, CURRENT_TIMESTAMP, 'Confirmée'),
(3, 4, CURRENT_TIMESTAMP, 'Annulée'),
(4, 5, CURRENT_TIMESTAMP, 'EN attente'),
(5, 1, CURRENT_TIMESTAMP, 'Confirmée');


UPDATE activite
SET 
    titre = 'Croisière sur le fleuve Bouregreg - Version Améliorée',
    description = 'Croisière relaxante et exclusive sur le fleuve Bouregreg, avec des vues magnifiques et des services de luxe',
    prix = 1500.00,
    date_debut = '2024-06-05',
    date_fin = '2024-06-20',
    places_disponsibles = 45
WHERE id_activite = 1;


DELETE FROM reservation
WHERE id_reservation = 1;


SELECT 
    c.id_client,
    c.nom,
    c.prenom,
    c.email,
    a.id_activite,
    a.titre,
    a.description,
    a.destination,
    a.prix,
    a.date_debut,
    a.date_fin,
    r.date_reservation,
    r.statut
FROM 
    client c
JOIN 
    reservation r ON c.id_client = r.id_client
JOIN 
    activite a ON r.id_activite = a.id_activite
WHERE 
    c.id_client = 2;

