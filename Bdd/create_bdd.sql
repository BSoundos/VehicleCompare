CREATE TABLE Utilisateur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    sexe ENUM('M', 'F'),
    date_de_naissance DATE,
    nom_utilisateur VARCHAR(255),
    mot_de_passe VARCHAR(255),
    email VARCHAR(255),
    role VARCHAR(20),
    statut ENUM('valide', 'bloque', 'non valide')
);

CREATE TABLE Marque (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    pays_origine VARCHAR(255),
    siege_social VARCHAR(255),
    annee_creation INT,
    lien VARCHAR(255),
    image_id INT,
    FOREIGN KEY (image_id) REFERENCES Image(id)

);

CREATE TABLE Modele (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    marque_id INT,
    FOREIGN KEY (marque_id) REFERENCES Marque(id)
);

CREATE TABLE Version (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    annee YEAR,
    modele_id INT,
    FOREIGN KEY (modele_id) REFERENCES Modele(id)
);


CREATE TABLE Vehicule (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    categorie ENUM('Voiture', 'Motocyclette', 'Vélo'),
    image_id INT,
    annee YEAR,
    note DOUBLE,
    tarif DOUBLE,
    dimensions VARCHAR(255),
    moteur VARCHAR(255),
    puissance INT,
    consommation DOUBLE,
    capacite INT,
    autre_performances VARCHAR(255),
    version_id INT,
    FOREIGN KEY (image_id) REFERENCES Image(id)
    FOREIGN KEY (version_id) REFERENCES Version(id)
);

CREATE TABLE Image (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lien TEXT
);

-- News & publicities
CREATE TABLE DiaporamaContenu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255),
    contenu TEXT,
    date DATE,
    lien VARCHAR(255),
    diapo BOOLEAN,
    image_id INT,
    FOREIGN KEY (image_id) REFERENCES Image(id)

);


CREATE TABLE Avis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    commentaire TEXT,
    note double,
    type INT, -- vehivule 0 or marque 1
    target_id INT,
    utilisateur_id INT,
    statut ENUM('valide', 'refuse', 'en attente'), 
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id)

);  




CREATE TABLE Favoris (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicule_id INT,
    utilisateur_id INT,
    FOREIGN KEY (vehicule_id) REFERENCES Vehicule(id),
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id)
);


-- Constituent le guide d'achats 
CREATE TABLE Conseil (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255),
    contenu TEXT,
    image_id INT,
    FOREIGN KEY (image_id) REFERENCES Image(id)
);

CREATE TABLE Comparaison (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicule1 INT,
    vehicule2 INT,
    nb INT,
    FOREIGN KEY (vehicule1) REFERENCES Vehicule(id),
    FOREIGN KEY (vehicule2) REFERENCES Vehicule(id)

);


CREATE TABLE news_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    text TEXT,
    image_id INT,
    news_id INT,
    FOREIGN KEY (image_id) REFERENCES Image(id),
    FOREIGN KEY (news_id) REFERENCES News(id)

);  



CREATE TABLE parameters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    image_id INT,
    FOREIGN KEY (image_id) REFERENCES Image(id)
);  