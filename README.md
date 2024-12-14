# Projet : Site Web de Réservation de Voyages

## Description
Une agence de voyage souhaite moderniser ses activités en développant un site web permettant la gestion des clients, la consultation des offres d'activités (vols, hôtels, circuits touristiques), et la réservation en ligne. Ce projet vise à offrir une solution numérique efficace pour remplacer le système manuel actuel.

## Objectifs
- Gérer les clients inscrits à l'agence.
- Afficher dynamiquement les offres d'activités disponibles.
- Permettre aux clients de réserver des activités en ligne et de personnaliser leurs choix.

---

## Fonctionnalités Principales

### Base de Données (ERD)
- Analyse des entités principales : Clients, Activités, Réservations.
- Identification des relations et interactions entre les entités.

### Modélisation et Conception
- Création des tables nécessaires à partir du schéma fourni.
- Ajout d'attributs ou tables supplémentaires pour des fonctionnalités comme les avis clients ou promotions.

### Diagramme UML
- Cas d'utilisation représentant les interactions principales :
  - Consultation des offres.
  - Réservation.
  - Personnalisation des voyages.

### Scripts SQL
- **Création des tables** : Clients, Activités, Réservations.
- **Opérations courantes** :
  - Insertion d'une nouvelle réservation.
  - Mise à jour des détails d'une activité.
  - Suppression d'une réservation.
  - Requêtes de jointure (ex. récupérer les activités réservées par un client).

### Développement PHP
- Formulaires pour ajouter des données (membres, activités, réservations).
- Affichage dynamique des données (ex. liste des membres, activités réservées).

---

## Structure du Projet

### Arborescence des Fichiers
```
project-root/
├── index.php
├── client.php
├── reservation.php
├── activites.php
├── connexion.php
└── README.md
```

### Configuration de l'Environnement
1. **Outils requis** :
   - Serveur local (ex. XAMPP, WAMP).
   - Éditeur de code (ex. Visual Studio Code).
2. **Étapes** :
   - Installer un serveur local et démarrer Apache/MySQL.
   - Créer la base de données à partir du schéma fourni.
   - Configurer le fichier `database.sql` pour la connexion à MySQL.

---

## Instructions d'Installation
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/HamzaBraik01/voyage.git
   ```
2. Importez le fichier SQL pour créer la base de données :
   - Accédez à phpMyAdmin.
   - Importez le fichier `database.sql`.
3. Configurez la connexion à la base de données dans `config/database.php`.
4. Lancez le projet sur votre serveur local (http://localhost/votre-projet).

---

## Exemples de Requêtes SQL

### Création des Tables
```sql
CREATE TABLE Clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100),
    telephone VARCHAR(20)
);

CREATE TABLE Activites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100),
    description TEXT,
    prix DECIMAL(10,2)
);

CREATE TABLE Reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    activite_id INT,
    date_reservation DATE,
    FOREIGN KEY (client_id) REFERENCES Clients(id),
    FOREIGN KEY (activite_id) REFERENCES Activites(id)
);
```

### Insertion de Données
```sql
INSERT INTO Clients (nom, email, telephone) VALUES ('Jean Dupont', 'jean.dupont@example.com', '0123456789');
INSERT INTO Activites (titre, description, prix) VALUES ('Visite guidée de Paris', 'Explorez Paris avec un guide expert.', 99.99);
INSERT INTO Reservations (client_id, activite_id, date_reservation) VALUES (1, 1, '2024-12-15');
```

---

## Technologies Utilisées
- **Backend** : PHP 8.2.12
- **Base de Données** : MySQL
- **Frontend** : HTML, CSS, JavaScript

