DROP DATABASE garage_parrot;
create DATABASE garage_parrot;
USE garage_parrot;

CREATE TABLE Users
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(250),
    password VARCHAR(250) NOT NULL,
    role VARCHAR(50) NOT NULL
);

INSERT INTO Users (first_name, last_name, email, password, role)
VALUES ('John', 'Doe', 'user@test.com', '$2y$10$RlCH9yL2mJKVccnNpKbVjenQSojNYu8eYr47CRRn48EbsiHeyvNeS', 'employé'),
       ('Vincent', 'Parrot', 'admin@test.com', '$2y$10$RlCH9yL2mJKVccnNpKbVjenQSojNYu8eYr47CRRn48EbsiHeyvNeS', 'admin');

CREATE TABLE Avis
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    comment VARCHAR(250) NOT NULL,
    note INT NOT NULL,
    validation TINYINT(1) NOT NULL,
    date_addition DATETIME NOT NULL,
);
INSERT INTO Avis (first_name, last_name, comment, note, validation, date_addition)
VALUES ('Martin', 'Tintin', 'Très bien', 5, 1, '2024-02-18 19:37:04'),
       ('John', 'Tintin', 'impeccable', 5, 1, '2024-02-16 19:37:04'),
       ('Samantha', 'Close', 'Equipe au top', 5, 1, '2024-02-15 19:37:04'),
       ('Laurence', 'Cher', 'Très bien', 5, 1, '2024-02-02 19:37:04'),
       ('Louis', 'Loulou', 'Très bien', 5, 0, '2024-02-18 19:37:04');
CREATE TABLE carburetion
(
    id_carburetion int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    carburetion VARCHAR(50) NOT NULL
);
INSERT INTO carburetion (carburetion)
VALUES ('essence'),('diesel'),('électrique'), ('GPL'), ('hybride'), ('hydrogène'), ('superéthanol'), ('GNV');

CREATE TABLE Brands
(
    id_brand int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    brand    VARCHAR(50) NOT NULL
);
create table Brands
(
    id_brand int auto_increment
        primary key,
    brand    varchar(50) not null
);

INSERT INTO Brands (brand) VALUES ('Renault'),('Citroën'),('Volkswagen'),('Jeep'),('Porsche'),('Seat');

CREATE TABLE Models
(
    id_model int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    model VARCHAR(50) NOT NULL,
    id_brand int,
    FOREIGN KEY (id_brand) REFERENCES Brands(id_brand)
);
INSERT INTO Models (model, id_brand) VALUES ('Clio Estate', 1),('C3', 2),('Combi', 3),('2 CV', 2),('Estafette', 1),('Karmann Ghia', 3),
                                            ('Traction Avant', 2),('Willys', 4),('996', 5),('850', 6),('NotchBack', 3),('Frégate', 1),('Coccinelle', 3);
CREATE TABLE Cars
(
    id_car INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_brand INT,
    id_model INT,
    id_carburetion INT,
    km INT,
    main_image VARCHAR(50),
    year INT,
    price FLOAT,
    date DATETIME,
    comment VARCHAR(255)
);
INSERT INTO Cars (id_brand, id_model, id_carburetion, km, main_image, year, price, date, comment)
VALUES (2, 4, 1, 137000, '65d253a951ad0-dyane4.jpg', 1980, 8000, '2024-02-18 19:59:54', 'Révision et peinture récentes'),
       (3, 13, 1, 153000, '65d2551ebb45a-coccinelle1.jpg', 1959, 13000, '2024-02-18 20:06:08', 'Magnifique cox rat&#039;s look'),
       (5, 9, 1, 117000, '65d2561488630-porsche-996-1.jpg', 1999, 29500, '2024-02-18 20:10:13', 'Magnifique Porsche 996 Carrera avec carnet.'),
       (4, 8, 1, 87000, '65d25716865e7-jeep4.jpg', 1952, 12000, '2024-02-18 20:14:31', 'Véhicule appartenant à un passionné. Bien entretenu mais restauration à prévoir.'),
       (6, 10, 1, 129000, '65d2583e5badd-seat850-1-1.jpg', 1974, 12500, '2024-02-18 20:19:27', 'Même modèle que la Fiat 850 mais version espagnole.'),
       (3, 11, 1, 173000, '65d259239cb2f-vw-notchback-2.jpg', 1972, 11000, '2024-02-18 20:23:17', 'Véhicule à restaurer'),
       (1, 12, 1, 153000, '65d259d149e52-fregate-2.jpg', 1953, 12000, '2024-02-18 20:26:10', 'Véhicule très bien entretenu et en très bon état'),
       (2, 4, 1, 151000, '65d25af006f0d-2cv-2.jpg', 1974, 6000, '2024-02-18 20:30:57', 'A redémarrer après 5 ans sans rouler'),
       (1, 5, 1, 181000, '65d25bd2a7898-estafette-2.jpg', 1968, 5500, '2024-02-18 20:34:44', 'Ancien corbillard de la ville de Paris, réhabilité en utilitaire. Intérieur à refaire'),
       (2, 4, 1, 105000, '65d25cec44d1b-2cv-charleston-1.jpg', 1975, 12000, '2024-02-18 20:39:25', '2CV Charleston entièrement refaite'),
       (3, 6, 1, 185000, '65d25e29e5bc6-karmann-ghia-1.jpg', 1971, 29500, '2024-02-18 20:44:43', 'Véhicule entièrement restauré avec passion.'),
       (2, 7, 1, 162000, '65d25f9f4829a-traction-1.jpg', 1951, 12500, '2024-02-18 20:49:32', 'Magnifique Traction Avant en très bon état');

CREATE TABLE Services
(id_service INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
title VARCHAR(50) NOT NULL,
comment VARCHAR(600) NOT NULL,
picture VARCHAR(255) NOT NULL,
id_user INT
);

insert INTO Services
VALUES
(NULL, 'mécanique', 'Nous assurons l’entretien général et la réfection des moteurs, boîte de vitesse, etc. Nous vous suivons et conseillons dans le choix de vos travaux, que ce soit une restauration ou un simple entretien.', './App/assets/images/service_default.png', 1);
insert INTO Services
VALUES
(NULL, 'carroserie & peinture', 'Nous assurons la restauration totale de la carrosserie, la peinture et le remplacement des éléments soudés tels que le plancher, bas de caisse, aile, le formage de tôle à l’identique et dans les règles de l’art, le sablage, les traitements anticorrosion et la mise en peinture complète de votre ancienne avec soins.', './App/assets/images/service_default.png', 1),
(NULL, 'sellerie & boiserie', 'La refabrication des sièges sera effectué par notre collaborateur qui nous fournit un travail de qualité. En ce qui concerne les poses de capote, du tonneau cover ou la remise en état, notre équipe s’en chargera comme à l’identique.', './App/assets/images/service_default.png', 1),
(NULL, 'électricité', 'Nous assurons le contrôle, la réparation ou le remplacement des faisceaux électriques. Notre spécialiste dispose d’une solide expérience dans le domaine depuis 30 ans dans l’automobile.', './App/assets/images/service_default.png', 1);


CREATE TABLE Subject
(id_subject INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
subject VARCHAR(255) NOT NULL);

insert INTO Subject
VALUES
    (NULL, 'Atelier mécanique'),
    (NULL, 'Atelier carroserie et peinture'),
    (NULL, 'Atelier selletie et boiserie'),
    (NULL, 'Atelier électricité'),
    (NULL, 'Je souhaite vendre un véhicule'),
    (NULL, 'Je suis intéressé par un véhicule');

CREATE TABLE FormContact
(id_contact INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
last_name VARCHAR(50) NOT NULL,
first_name VARCHAR(50) NOT NULL,
phone_number VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
comment VARCHAR(255) NOT NULL,
date_addition DATETIME NOT NULL,
id_subject INT,
FOREIGN KEY (id_subject) REFERENCES Subject(id_subject)
);

CREATE TABLE Timetable
(id_day INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
day VARCHAR(50) NOT NULL,
ouverture_am VARCHAR(50),
fermeture_am VARCHAR(50),
ouverture_pm VARCHAR(50),
fermeture_pm VARCHAR(50)
);
INSERT INTO Timetable VALUES
(NULL, 'Lundi', '08:30', '12:30', '14:00', '19:00'),
(NULL, 'Mardi', '08:30', '12:30', '14:00', '19:00'),
(NULL, 'Mercredi', '08:30', '12:30', '14:00', '19:00'),
(NULL, 'Jeudi', '08:30', '12:30', '14:00', '19:00'),
(NULL, 'Vendredi','08:30', '12:30', '14:00', '19:00'),
(NULL, 'Samedi','08:30', '12:30', '14:00', '19:00'),
(NULL, 'Dimanche', 'Fermé', 'Fermé', 'Fermé', 'Fermé');

CREATE TABLE Pictures
(
    id_picture INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_car INT,
    path VARCHAR(255),
FOREIGN KEY (id_car) REFERENCES Cars(id_car)
);
INSERT INTO Pictures VALUES
(NULL, 1, 'voiture_default.jpg'),
(NULL, 1, 'voiture_default.jpg'),
(NULL, 1, 'voiture_default.jpg'),
(NULL, 1, 'voiture_default.jpg');

insert into Pictures (id_car, path)
values  (1, '65d253a967882-dyane5.jpg'),
        (1, '65d253a97bed3-dyane6.jpg'),
        (1, '65d253a986b19-dyane7.jpg'),
        (2, '65d2551ecca14-coccinelle2.jpg'),
        (2, '65d2551f26a85-coccinelle4.jpg'),
        (2, '65d2551f2fcbb-coccinelle5.jpg'),
        (2, '65d2551f38ba2-coccinelle7.jpg'),
        (3, '65d256148fc49-porsche-996-2.jpg'),
        (3, '65d256149da26-porsche-996-3.jpg'),
        (4, '65d25716935ef-jeep2.jpg'),
        (4, '65d257169bc52-jeep3.jpg'),
        (4, '65d25716a4440-jeep5.jpg'),
        (4, '65d25716b1ea2-jeep6.jpg'),
        (5, '65d2583e67cdf-seat850-1-3.jpg'),
        (5, '65d2583e745ea-seat850-1-4.jpg'),
        (5, '65d2583e807a9-seat850-1-6.jpg'),
        (5, '65d2583e89d22-seat850-1-7.jpg'),
        (6, '65d25923b7e2f-vw-notchback-3.jpg'),
        (6, '65d25923c171b-vw-notchback-4.jpg'),
        (6, '65d25923d102c-vw-notchback-5.jpg'),
        (7, '65d259d154a17-fregate-1.jpg'),
        (7, '65d259d1afe03-fregate-3.jpg'),
        (7, '65d259d1c1ded-fregate-5.jpg'),
        (8, '65d25af00edb9-2cv-1.jpg'),
        (8, '65d25af016d5d-2cv-3.jpg'),
        (8, '65d25af023e01-2cv-4.jpg'),
        (9, '65d25bd2ae646-estafette-1.jpg'),
        (9, '65d25bd2b5718-estafette-3.jpg'),
        (9, '65d25bd2beb67-estafette-5.jpg'),
        (9, '65d25bd2c5b50-estafette-6.jpg'),
        (10, '65d25cec5da1d-2cv-charleston-3.jpg'),
        (10, '65d25cec6bd67-2cv-charleston-5.jpg'),
        (10, '65d25d116ec02-2cv-charleston-4.jpg'),
        (11, '65d25e29f0e10-karmann-ghia-2.jpg'),
        (11, '65d25e2a07b6c-karmann-ghia-6.jpg'),
        (11, '65d25e2a13fb1-karmann-ghia-9.jpg'),
        (11, '65d25e2a1e5aa-karmann-ghia-10.jpg'),
        (12, '65d25f4b61230-traction-2.jpg'),
        (12, '65d25f4b6abd8-traction-4.jpg'),
        (12, '65d25f4b75544-traction-5.jpg'),
        (12, '65d25f4b7fdab-traction-6.jpg');

DELIMITER //

CREATE PROCEDURE delete_car
    (IN id_car_delete INT)
BEGIN
  DELETE FROM Pictures
  WHERE id_car = id_car_delete;

  DELETE FROM Cars
  WHERE id_car = id_car_delete;
END //

DELIMITER ;
