-- ============================================================
-- Base de données : location_auto
-- Système de location de voitures (TP1 - 582-31B-MA)
-- Ce script recrée entièrement la base, les tables et les données de test.
-- ============================================================

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS location_auto;
CREATE DATABASE location_auto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE location_auto;

-- Catégories de véhicules (VUS, compacte, etc.)
CREATE TABLE categorie (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(50)  NOT NULL UNIQUE,
    description VARCHAR(255)
) ENGINE=InnoDB;

-- Voitures : chaque voiture appartient à UNE catégorie (relation 1-N)
CREATE TABLE voiture (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    marque       VARCHAR(50)  NOT NULL,
    modele       VARCHAR(50)  NOT NULL,
    annee        SMALLINT     NOT NULL,
    plaque       VARCHAR(10)  NOT NULL UNIQUE,
    prix_jour    DECIMAL(7,2) NOT NULL,
    categorie_id INT          NOT NULL,
    CONSTRAINT fk_voiture_categorie FOREIGN KEY (categorie_id)
        REFERENCES categorie(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Clients
CREATE TABLE client (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    prenom    VARCHAR(50)  NOT NULL,
    nom       VARCHAR(50)  NOT NULL,
    courriel  VARCHAR(100) NOT NULL UNIQUE,
    telephone VARCHAR(20)
) ENGINE=InnoDB;

-- Locations : un client peut avoir plusieurs locations (relation 1-N)
CREATE TABLE location (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    client_id  INT  NOT NULL,
    date_debut DATE NOT NULL,
    date_fin   DATE NOT NULL,
    CONSTRAINT fk_location_client FOREIGN KEY (client_id)
        REFERENCES client(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

-- Table pivot : une location contient plusieurs voitures et
-- une voiture apparaît dans plusieurs locations (relation N-N)
CREATE TABLE location_voiture (
    location_id INT NOT NULL,
    voiture_id  INT NOT NULL,
    PRIMARY KEY (location_id, voiture_id),
    CONSTRAINT fk_lv_location FOREIGN KEY (location_id)
        REFERENCES location(id) ON DELETE CASCADE,
    CONSTRAINT fk_lv_voiture FOREIGN KEY (voiture_id)
        REFERENCES voiture(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------- Données de test ----------
INSERT INTO categorie (nom, description) VALUES
('Compacte',  'Petite voiture économique, idéale en ville'),
('VUS',       'Véhicule utilitaire sport, 5 places et grand coffre'),
('Électrique','Zéro émission, recharge incluse'),
('Fourgonnette','7 places, parfaite pour les familles');

INSERT INTO voiture (marque, modele, annee, plaque, prix_jour, categorie_id) VALUES
('Honda',   'Civic',    2023, 'H4K 2L9', 54.00, 1),
('Toyota',  'Corolla',  2022, 'G7P 1M3', 52.00, 1),
('Toyota',  'RAV4',     2024, 'K2X 8B5', 79.00, 2),
('Hyundai', 'Kona EV',  2024, 'V1E 3C7', 69.00, 3),
('Tesla',   'Model 3',  2023, 'T3S 4L4', 95.00, 3),
('Chrysler','Pacifica', 2022, 'F9N 6D2', 89.00, 4);

INSERT INTO client (prenom, nom, courriel, telephone) VALUES
('Amélie', 'Tremblay', 'amelie.tremblay@exemple.ca', '514-555-0142'),
('Karim',  'Benali',   'karim.benali@exemple.ca',    '438-555-0177'),
('Sophie', 'Gagnon',   'sophie.gagnon@exemple.ca',   '450-555-0119');

INSERT INTO location (client_id, date_debut, date_fin) VALUES
(1, '2026-10-05', '2026-10-08'),
(2, '2026-10-10', '2026-10-12'),
(3, '2026-10-15', '2026-10-20');

INSERT INTO location_voiture (location_id, voiture_id) VALUES
(1, 1),
(2, 3), (2, 4),
(3, 6);
