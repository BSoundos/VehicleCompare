-- Utilisateurs
INSERT INTO Utilisateur (nom, prenom, sexe, date_de_naissance, nom_utilisateur, mot_de_passe, email, role, statut)
VALUES
  ('Kouadri', 'Nada', 'F', '1990-05-15', 'ln_kouadri', 'mdp_nada', 'ln_kouadri@esi.dz', 'client', 'valide'),
  ('Sansri', 'Ibtihel', 'F', '1987-08-22', 'ki_sansri', 'mdp_ibti', 'ki_sansri@email.com', 'client', 'valide'),
  ('Benni', 'Mohamed', 'M', '2001-02-10', 'km_benni', 'mdp_med', 'km_benni@email.com', 'client', 'valide'),
  ('Kouadri', 'Taqiy', 'F', '1995-11-30', 'kt_kouadri', 'mdp_taqiy', 'kt_kouadri@email.com', 'client', 'valide'),
  ('', '', 'M', '1988-06-18', 'admin', 'admin', 'admin@email.com', 'admin', 'valide');


-- Marques 
INSERT INTO Marque (nom, pays_origine, siege_social, annee_creation,lien,image_id)
VALUES
  ('Toyota', 'Japon', 'Toyota', 1937,
  'https://www.toyota.com/',23),
  ('Renault', 'France', 'Boulogne-Billancourt', 1898,
  'https://www.renault.dz/',24),
  ('Ford', 'USA', 'Dearborn', 1903,
  'https://www.ford.com/',25),
  ('Fiat', 'Italie', 'Turin', 1899,
  'https://www.fiat.dz/',26),
  ('Nissan', 'Japon', 'Yokohama', 1933,
  'https://www.nissan.fr/',27);



-- Modeles
INSERT INTO Modele (nom, marque_id)  
VALUES
  -- Toyota
  ('Corolla', 1),  
  ('Prius', 1),
  ('RAV4', 1),
  
  -- Renault
  ('Clio', 2),
  ('Captur', 2),
  ('Megane', 2),
  
  -- Ford 
  ('Fiesta', 3),
  ('Focus', 3),
  ('Mustang', 3),
  
  -- Fiat
  ('500', 4),
  ('Panda', 4),
  ('Tipo', 4),

  -- Nissan
  ('Micra', 5),
  ('Juke', 5),
  ('Qashqai', 5);  



-- Versions
INSERT INTO Version (nom, annee, modele_id)
VALUES
  ('LE', 2023, 1),
  ('Hybrid', 2023, 2),
  ('Adventure', 2023, 3),

  ('Zen', 2023, 4),
  ('Intens', 2023, 5),
  ('RS', 2023, 6),

  ('Trend', 2023, 7),
  ('Titanium', 2023, 8),
  ('Mach-E', 2023, 9),

  ('Pop', 2023, 10),
  ('Cross', 2023, 11),
  ('Lounge', 2023, 12),

  ('Visia', 2023, 13),
  ('N-Connecta', 2023, 14),
  ('Tekna', 2023, 15);


-- Vehicules
INSERT INTO Vehicule (nom, categorie, image_id, annee, note, tarif, dimensions, moteur, puissance, consommation, capacite, autre_performances, version_id)
VALUES
  -- Toyota
  ('Corolla LE', 'Voiture', 1, 2023, 4.5, 25000.00, '4500x1800x1600', 'Essence', 150, 7.5, 5, 'Acceleration 0-100 km/h en 8.2s', 1),
  ('Prius Hybrid', 'Voiture', 2, 2023, 4.8, 30000.00, '4600x1760x1490', 'Hybride', 120, 5.0, 5, 'Consommation mixte 4.5 l/100km', 2),
  ('RAV4 Adventure', 'Voiture', 3, 2023, 4.7, 35000.00, '4655x1855x1700', 'Essence', 203, 8.3, 5, 'Transmission intégrale', 3),

  -- Renault
  ('Clio Zen', 'Voiture', 4, 2023, 4.5, 18000.00, '4050x1798x1440', 'Essence', 90, 6.0, 5, 'Écran tactile 7 pouces', 4),
  ('Captur Intens', 'Voiture', 5, 2023, 4.8, 22000.00, '4227x1778x1576', 'Essence', 130, 6.5, 5, 'Toit panoramique en verre', 5),
  ('Megane RS', 'Voiture', 6, 2023, 4.7, 35000.00, '4371x1871x1447', 'Essence', 300, 7.0, 5, 'Châssis sport', 6),

  -- Ford
  ('Fiesta Trend', 'Voiture', 7, 2023, 4.6, 17000.00, '4040x1735x1476', 'Essence', 85, 5.8, 5, 'Système de son Bang & Olufsen',7),
  ('Focus Titanium', 'Voiture', 8, 2023, 4.9, 24000.00, '4378x1825x1454', 'Essence', 150, 6.5, 5, 'Sièges en cuir chauffants',8),
  ('Mustang Mach-E', 'Voiture', 9, 2023, 4.8, 50000.00, '4732x1882x1614', 'Électrique', 290, 0.0, 5, 'Autonomie de 480 km',9),

  -- Fiat
  ('500 Pop', 'Voiture', 10, 2023, 4.7, 15000.00, '3571x1627x1488', 'Essence', 69, 5.1, 4, 'Intérieur personnalisable',10),
  ('Panda Cross', 'Voiture', 11, 2023, 4.6, 18000.00, '3999x1714x1667', 'Essence', 85, 5.0, 4, 'Système de navigation Uconnect', 11),
  ('Tipo Lounge', 'Voiture', 12, 2023, 4.5, 20000.00, '4500x1796x1495', 'Diesel', 120, 4.5, 5, 'Climatisation automatique', 12),

  -- Nissan
  ('Micra Visia', 'Voiture', 13, 2023, 4.5, 16000.00, '3999x1743x1455', 'Essence', 71, 5.8, 5, 'Caméra de recul',13),
  ('Juke N-Connecta', 'Voiture', 14, 2023, 4.8, 22000.00, '4210x1805x1595', 'Essence', 117, 6.0, 5, 'Système de navigation NissanConnect',14),
  ('Qashqai Tekna', 'Voiture', 15, 2023, 4.7, 28000.00, '4394x1839x1590', 'Diesel', 150, 4.7, 5, 'Toit panoramique en verre', 15);

-- Images
INSERT INTO Image (lien)
VALUES
  ('img/toyota-corolla.jpg'),
  ('img/Prius-Hybrid.jpg'),
  ('img/RAV4-Adventure.png'),
  ('img/Clio-Zen.jpg'),
  ('img/Captur-Intens.jpg'),
  ('img/Megane-RS.jpg'),
  ('img/Fiesta-Trend.jpg'),
  ('img/Focus-Titanium.jpg'),
  ('img/Mustang-Mach-E.jpg'),
  ('img/500-Pop.jpg'),
  ('img/Panda-Cross.jpg'),
  ('img/Tipo-Lounge.jpg'),
  ('img/Micra-Visia.png'),
  ('img/Juke-N-Connecta.jpg'),
  ('img/Qashqai-Tekna.jpg'),
  ('img/news1.jpg'),
  ('img/news2.jpg'),
  ('img/news3.jpg'),
  ('img/news4.jpg'),
  ('img/news5.jpg'),
  ('img/conseil1.jpg'),
  ('img/conseil2.jpg'),
  ('img/Toyota.png'),
  ('img/Renault.jpg'),
  ('img/ford.jpg'),
  ('img/fiat.jpg'),
  ('img/nissan.jpg'),
  ('img/news1_1.jpg'),
  ('img/user.png'),
  ('img/parameter.png'),
  ('img/avis.png'),
  ('img/news.png'),
  ('img/vehicule.png')
  ;

-- Actualite
INSERT INTO DiaporamaContenu (titre, contenu, date, lien, diapo, image_id)
VALUES 
    ('Mazda prévoit lancer 7 ou 8 véhicules électriques d’ici 2030', 'La course à l’électrification est commencée, et Mazda compte bien retirer une part du gâteau. Même s’il semble prendre du temps à commercialiser des véhicules électriques sur notre marché, le constructeur a réitéré récemment, par la bouche de son PDG en entrevue avec Automotive News, de le faire dans les prochaines années. Selon son propos, on peut s’attendre à 7 ou 8 produits entièrement électriques d’ici 2030.', '2023-12-12', 'https://www.msn.com/fr-ca/style-de-vie/tendances/mazda-pr%C3%A9voit-lancer-7-ou-8-v%C3%A9hicules-%C3%A9lectriques-d-ici-2030/ar-AA1loSDj', TRUE, 16),
    ('UN VÉHICULE D’INTERVENTION DE 666 CHEVAUX POUR LA POLICE ITALIENNE !', 'Description de l''actualité...', '2023-12-11', 'https://www.autojournal.fr/actu/insolites-actu/vehicule-intervention-666-chevaux-police-italie-lamborghini-urus-performante-2024-nouveaute-323895.html', TRUE, 17),
    ('Nouvelle technologie de batteries révolutionnaires pour voitures électriques', 
     'Une équipe de chercheurs a développé une nouvelle technologie de batteries qui promet d''augmenter considérablement l''autonomie des voitures électriques. Cette avancée pourrait révolutionner l''industrie automobile et accélérer la transition vers les véhicules électriques.', 
     '2023-12-10', 
     'https://www.frandroid.com/survoltes/voitures-electriques/1750459_voici-la-nouvelle-batterie-revolutionnaire-des-voitures-electriques-peugeot-citroen-fiat-opel-et-jeep', 
     TRUE, 
     18),
    
    ('Le marché des SUV en plein essor avec de nouveaux modèles attendus en 2024', 
     'Les SUV continuent de gagner en popularité, et plusieurs constructeurs annoncent de nouveaux modèles pour l''année 2024. Ces véhicules offriront des fonctionnalités avancées, un design élégant et des performances améliorées.', 
     '2023-12-09', 
     'https://www.autoplus.fr/actualite/suv-voici-les-modeles-stars-de-2024-1139081.html', 
     TRUE, 
     19),
    
    ('Essai routier exclusif du dernier modèle de voiture autonome', 
     'Nous avons eu l''occasion de tester en exclusivité le dernier modèle de voiture autonome. Découvrez nos impressions sur la conduite sans intervention humaine et les avancées technologiques qui rendent cela possible.', 
     '2023-12-08', 
     'https://www.automobile-propre.com/essai-tesla-model-3-grande-autonomie-prise-en-main-exclusive-highland/', 
     TRUE, 
     20);


-- Conseils
INSERT INTO Conseil (titre, contenu, image_id)
VALUES
  ('Conseils d''entretien', 'Découvrez comment entretenir votre véhicule pour garantir sa longévité.', 21),
  ('Choisir le bon modèle', 'Guide pour choisir le modèle de véhicule qui correspond le mieux à vos besoins.', 22),
  ('Les Étapes Essentielles', 'test' , 38); 


INSERT INTO Comparaison (vehicule1, vehicule2, nb) VALUES
(1, 2, 3), 
(2, 3, 4),
(1, 4, 9), 
(2, 5, 17),
(3, 4, 1);

INSERT INTO news_details (text,image_id,news_id) VALUES
('La vision qu’a Masahiro Moro, actuel PDG de Mazda et ancien PDG de Mazda pour l’Amérique du Nord, repose essentiellement sur une architecture unique sur laquelle une équipe de près de 100 personnes est en train de travailler. Cette architecture sera modulable et sous-tendra les produits que lancera le constructeur d’ici 2030. Le constructeur estime que 25 % à 40 % des véhicules vendus seront électriques en 2030, se gardant d’être plus précis compte tenu de l’instabilité du marché actuel.', 18, 1), 
('La légèreté, et la rentabilité
Le principe de base qu’il met à l’avant-plan est l’efficacité et la légèreté. C’est, selon lui, la seule avenue pour rendre les véhicules électriques logiques, du point de vue financier. Même s’il n’a pas voulu confirmer les détails mécaniques, notamment parce qu’il estime qu’il peut se passer beaucoup de choses d’ici l’arrivée prévue en 2025, Masahiro Moro mentionne que le constructeur évalue actuellement ses options. Il envisage des moteurs électriques plus puissants et moins puissants, qui pourraient être disponibles en formule à un ou deux moteurs. L’une des préoccupations semble la taille de la batterie, parce qu’une plus grande capacité équivaut automatiquement à un prix et un poids plus élevés.Selon lui, Mazda essaiera de se différencier des autres constructeurs. Alors que nous voyons actuellement beaucoup de VUS à la ligne de toit surbaissée, pour améliorer le coefficient de pénétration dans l’air, Mazda tentera vraisemblablement de continuer à adopter une forme typique de VUS, très verticale. Des 7 ou 8 produits prévus, rien n’indique quelle quantité sera vendue chez nous.

Pour finir, pour améliorer la rentabilité et séparer les coûts de fabrication, Mazda travaillera avec Toyota pour l’architecture logicielle et électronique de ses véhicules électriques. Selon Moro, les composants matériels demeureront individuels pour les deux marques, mais le partage des logiciels, pour ces produits aussi importants, permettra de limiter de 70 % à 80 % l’investissement total pour l’électrification de la gamme.', 23, 1),
;


INSERT INTO Image (lien)
VALUES
  ('img/Bentley.jpg'),
  ('img/Audi.jpg'),
  ('img/Hyundai.jpg'),
  ('img/Mercedes-Benz.jpg');




INSERT INTO Marque (nom, pays_origine, siege_social, annee_creation, lien, image_id)
VALUES
  ('Bentley', 'United Kingdom', 'Crewe, England', '1919', 'https://www.bentleymotors.com/', 29),
  ('Audi', 'Germany', 'Ingolstadt, Germany', '1909', 'https://www.audi.com', 30),
  ('Hyundai', 'South Korea', 'Seoul, South Korea', '1967', 'https://www.hyundai.com/fr/fr.html', 31),
  ('Mercedes-Benz', 'Germany', 'Stuttgart, Germany', '1926', 'https://www.mercedes-benz.com/', 32);


INSERT INTO Avis (commentaire, note, type, target_id,utilisateur_id,statut)
VALUES
    ('awesome',5,0,1,1,'en attente'),
    ('awesome 1',4,0,1,2,'en attente'),
    ('awesome 2',3,0,1,3,'en attente');


INSERT INTO Avis (commentaire, note, type, target_id, utilisateur_id, statut)
VALUES
    ('Great car!', 4.5, 0, 1, 1, 'valide'),
    ('Needs improvement in fuel efficiency.', 3.2, 0, 2, 2, 'en attente'),
    ('Excellent brand!', 4.8, 1, 1, 3, 'valide'),
    ('Average performance.', 3.0, 1, 2, 4, 'valide'),
    ('Smooth driving experience.', 4.6, 0, 3, 5, 'en attente');

