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