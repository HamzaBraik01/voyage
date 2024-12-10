create database voyage;

create table client (
    id_client int ,
    nom varchar(100),
    prenom varchar(100),
    email varchar(150),
    telephone varchar(15),
    adresse text,
    date_naissance DATE
);

create table reservation( 
    id_reservation int, 
    id_client int, 
    id_activite int, 
    date_reservation TIMESTAMP,
    statut ENUM('EN attente', 'Confirmée', 'Annulée') 
);

create table activite(
    id_activite int,
    titre varchar(150),
    description text,
    destination varchar(100),
    prix DECIMAL(10, 2) NOT NULL,
    date_debut date,
    date_fin date,
    places_disponsibles int NOT NULL
    
);


ALTER TABLE client 
ADD PRIMARY KEY (id_client, email);

ALTER TABLE client
MODIFY id_client int AUTO_INCREMENT;

ALTER TABLE activite 
ADD PRIMARY KEY (id_activite);

ALTER TABLE activite
MODIFY id_activite int AUTO_INCREMENT;

ALTER TABLE reservation 
ADD PRIMARY KEY (id_reservation);


ALTER TABLE reservation
ADD FOREIGN KEY (id_client) REFERENCES client (id_client),
ADD FOREIGN KEY (id_activite) REFERENCES activite (id_activite);

INSERT INTO client (nom, prenom, email, telephone, adresse, date_naissance)
VALUES 
('El Amrani', 'Ahmed', 'ahmed.elamrani@example.com', '0612345678', '123 rue Mohammed V, Casablanca', '1985-02-15'),
('Benkirane', 'Fatima', 'fatima.benkirane@example.com', '0698765432', '456 avenue Al Qods, Rabat', '1990-07-22'),
('Mouhib', 'Youssef', 'youssef.mouhib@example.com', '0623456789', '789 boulevard Hassan II, Marrakech', '1983-11-30'),
('El Fassi', 'Samira', 'samira.elfassi@example.com', '0654321098', '321 rue des Oliviers, Fès', '1995-03-11'),
('Ait Lahcen', 'Mohammed', 'mohammed.aitlahcen@example.com', '0687654321', '654 impasse des Jardins, Agadir', '1992-06-25'),
('El Hamrei', 'aida', 'aida.elfassi@example.com', '0685321098', '321 rue des Oliviers, Safi', '1995-03-11')
;

