-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 jan. 2024 à 21:29
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `comparateur_vehicules`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commentaire` text,
  `note` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `vehicule_id` int DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  `statut` enum('valide','refuse','en attente') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicule_id` (`vehicule_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comparaison`
--

DROP TABLE IF EXISTS `comparaison`;
CREATE TABLE IF NOT EXISTS `comparaison` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicule1` int DEFAULT NULL,
  `vehicule2` int DEFAULT NULL,
  `nb` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicule1` (`vehicule1`),
  KEY `vehicule2` (`vehicule2`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comparaison`
--

INSERT INTO `comparaison` (`id`, `vehicule1`, `vehicule2`, `nb`) VALUES
(1, 1, 2, 3),
(2, 2, 3, 4),
(3, 1, 4, 9),
(4, 2, 5, 17),
(5, 3, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `conseil`
--

DROP TABLE IF EXISTS `conseil`;
CREATE TABLE IF NOT EXISTS `conseil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` text,
  `image_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `conseil`
--

INSERT INTO `conseil` (`id`, `titre`, `contenu`, `image_id`) VALUES
(1, 'Conseils d\'entretien', 'Découvrez comment entretenir votre véhicule pour garantir sa longévité.', 21),
(2, 'Choisir le bon modèle', 'Guide pour choisir le modèle de véhicule qui correspond le mieux à vos besoins.', 22);

-- --------------------------------------------------------

--
-- Structure de la table `diaporamacontenu`
--

DROP TABLE IF EXISTS `diaporamacontenu`;
CREATE TABLE IF NOT EXISTS `diaporamacontenu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` text,
  `date` date DEFAULT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `diapo` tinyint(1) DEFAULT NULL,
  `image_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `diaporamacontenu`
--

INSERT INTO `diaporamacontenu` (`id`, `titre`, `contenu`, `date`, `lien`, `diapo`, `image_id`) VALUES
(1, 'Mazda prévoit lancer 7 ou 8 véhicules électriques d’ici 2030', 'La course à l’électrification est commencée, et Mazda compte bien retirer une part du gâteau. Même s’il semble prendre du temps à commercialiser des véhicules électriques sur notre marché, le constructeur a réitéré récemment, par la bouche de son PDG en entrevue avec Automotive News, de le faire dans les prochaines années. Selon son propos, on peut s’attendre à 7 ou 8 produits entièrement électriques d’ici 2030.', '2023-12-12', 'https://www.msn.com/fr-ca/style-de-vie/tendances/mazda-pr%C3%A9voit-lancer-7-ou-8-v%C3%A9hicules-%C3%A9lectriques-d-ici-2030/ar-AA1loSDj', 1, 16),
(2, 'UN VÉHICULE D’INTERVENTION DE 666 CHEVAUX POUR LA POLICE ITALIENNE !', 'Description de l\'actualité...', '2023-12-11', 'https://www.autojournal.fr/actu/insolites-actu/vehicule-intervention-666-chevaux-police-italie-lamborghini-urus-performante-2024-nouveaute-323895.html', 1, 17),
(3, 'Nouvelle technologie de batteries révolutionnaires pour voitures électriques', 'Une équipe de chercheurs a développé une nouvelle technologie de batteries qui promet d\'augmenter considérablement l\'autonomie des voitures électriques. Cette avancée pourrait révolutionner l\'industrie automobile et accélérer la transition vers les véhicules électriques.', '2023-12-10', 'https://www.frandroid.com/survoltes/voitures-electriques/1750459_voici-la-nouvelle-batterie-revolutionnaire-des-voitures-electriques-peugeot-citroen-fiat-opel-et-jeep', 1, 18),
(4, 'Le marché des SUV en plein essor avec de nouveaux modèles attendus en 2024', 'Les SUV continuent de gagner en popularité, et plusieurs constructeurs annoncent de nouveaux modèles pour l\'année 2024. Ces véhicules offriront des fonctionnalités avancées, un design élégant et des performances améliorées.', '2023-12-09', 'https://www.autoplus.fr/actualite/suv-voici-les-modeles-stars-de-2024-1139081.html', 1, 19),
(5, 'Essai routier exclusif du dernier modèle de voiture autonome', 'Nous avons eu l\'occasion de tester en exclusivité le dernier modèle de voiture autonome. Découvrez nos impressions sur la conduite sans intervention humaine et les avancées technologiques qui rendent cela possible.', '2023-12-08', 'https://www.automobile-propre.com/essai-tesla-model-3-grande-autonomie-prise-en-main-exclusive-highland/', 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicule_id` int DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicule_id` (`vehicule_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lien` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `lien`) VALUES
(1, 'img/toyota-corolla.jpg'),
(2, 'img/Prius-Hybrid.jpg'),
(3, 'img/RAV4-Adventure.png'),
(4, 'img/Clio-Zen.jpg'),
(5, 'img/Captur-Intens.jpg'),
(6, 'img/Megane-RS.jpg'),
(7, 'img/Fiesta-Trend.jpg'),
(8, 'img/Focus-Titanium.jpg'),
(9, 'img/Mustang-Mach-E.jpg'),
(10, 'img/500-Pop.jpg'),
(11, 'img/Panda-Cross.jpg'),
(12, 'img/Tipo-Lounge.jpg'),
(13, 'img/Micra-Visia.png'),
(14, 'img/Juke-N-Connecta.jpg'),
(15, 'img/Qashqai-Tekna.jpg'),
(16, 'img/news1.jpg'),
(17, 'img/news2.jpg'),
(18, 'img/news3.jpg'),
(19, 'img/news4.jpg'),
(20, 'img/news5.jpg'),
(21, 'img/conseil1.jpg'),
(22, 'img/conseil2.jpg'),
(23, 'img/Toyota.png'),
(24, 'img/Renault.jpg'),
(25, 'img/ford.jpg'),
(26, 'img/fiat.jpg'),
(27, 'img/nissan.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `pays_origine` varchar(255) DEFAULT NULL,
  `siege_social` varchar(255) DEFAULT NULL,
  `annee_creation` int DEFAULT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `image_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `nom`, `pays_origine`, `siege_social`, `annee_creation`, `lien`, `image_id`) VALUES
(1, 'Toyota', 'Japon', 'Toyota', 1937, 'https://www.toyota.com/', 23),
(2, 'Renault', 'France', 'Boulogne-Billancourt', 1898, 'https://www.renault.dz/', 24),
(3, 'Ford', 'USA', 'Dearborn', 1903, 'https://www.ford.com/', 25),
(4, 'Fiat', 'Italie', 'Turin', 1899, 'https://www.fiat.dz/', 26),
(5, 'Nissan', 'Japon', 'Yokohama', 1933, 'https://www.nissan.fr/', 27);

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `marque_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marque_id` (`marque_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`id`, `nom`, `marque_id`) VALUES
(1, 'Corolla', 1),
(2, 'Prius', 1),
(3, 'RAV4', 1),
(4, 'Clio', 2),
(5, 'Captur', 2),
(6, 'Megane', 2),
(7, 'Fiesta', 3),
(8, 'Focus', 3),
(9, 'Mustang', 3),
(10, '500', 4),
(11, 'Panda', 4),
(12, 'Tipo', 4),
(13, 'Micra', 5),
(14, 'Juke', 5),
(15, 'Qashqai', 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` enum('M','F') DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `nom_utilisateur` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `statut` enum('valide','bloque','non valide') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `sexe`, `date_de_naissance`, `nom_utilisateur`, `mot_de_passe`, `email`, `role`, `statut`) VALUES
(1, 'Kouadri', 'Nada', 'F', '1990-05-15', 'ln_kouadri', 'mdp_nada', 'ln_kouadri@esi.dz', 'client', 'valide'),
(2, 'Sansri', 'Ibtihel', 'F', '1987-08-22', 'ki_sansri', 'mdp_ibti', 'ki_sansri@email.com', 'client', 'valide'),
(3, 'Benni', 'Mohamed', 'M', '2001-02-10', 'km_benni', 'mdp_med', 'km_benni@email.com', 'client', 'valide'),
(4, 'Kouadri', 'Taqiy', 'F', '1995-11-30', 'kt_kouadri', 'mdp_taqiy', 'kt_kouadri@email.com', 'client', 'valide'),
(5, '', '', 'M', '1988-06-18', 'admin', 'admin', 'admin@email.com', 'admin', 'valide');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `categorie` enum('Voiture','Motocyclette','Vélo') DEFAULT NULL,
  `image_id` int DEFAULT NULL,
  `annee` year DEFAULT NULL,
  `note` double DEFAULT NULL,
  `tarif` double DEFAULT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `moteur` varchar(255) DEFAULT NULL,
  `puissance` int DEFAULT NULL,
  `consommation` double DEFAULT NULL,
  `capacite` int DEFAULT NULL,
  `autre_performances` varchar(255) DEFAULT NULL,
  `version_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `version_id` (`version_id`),
  KEY `fk_image_id` (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `nom`, `categorie`, `image_id`, `annee`, `note`, `tarif`, `dimensions`, `moteur`, `puissance`, `consommation`, `capacite`, `autre_performances`, `version_id`) VALUES
(1, 'Corolla LE', 'Voiture', 1, 2023, 4.5, 25000, '4500x1800x1600', 'Essence', 150, 7.5, 5, 'Acceleration 0-100 km/h en 8.2s', 1),
(2, 'Prius Hybrid', 'Voiture', 2, 2023, 4.8, 30000, '4600x1760x1490', 'Hybride', 120, 5, 5, 'Consommation mixte 4.5 l/100km', 2),
(3, 'RAV4 Adventure', 'Voiture', 3, 2023, 4.7, 35000, '4655x1855x1700', 'Essence', 203, 8.3, 5, 'Transmission intégrale', 3),
(4, 'Clio Zen', 'Voiture', 4, 2023, 4.5, 18000, '4050x1798x1440', 'Essence', 90, 6, 5, 'Écran tactile 7 pouces', 4),
(5, 'Captur Intens', 'Voiture', 5, 2023, 4.8, 22000, '4227x1778x1576', 'Essence', 130, 6.5, 5, 'Toit panoramique en verre', 5),
(6, 'Megane RS', 'Voiture', 6, 2023, 4.7, 35000, '4371x1871x1447', 'Essence', 300, 7, 5, 'Châssis sport', 6),
(7, 'Fiesta Trend', 'Voiture', 7, 2023, 4.6, 17000, '4040x1735x1476', 'Essence', 85, 5.8, 5, 'Système de son Bang & Olufsen', 7),
(8, 'Focus Titanium', 'Voiture', 8, 2023, 4.9, 24000, '4378x1825x1454', 'Essence', 150, 6.5, 5, 'Sièges en cuir chauffants', 8),
(9, 'Mustang Mach-E', 'Voiture', 9, 2023, 4.8, 50000, '4732x1882x1614', 'Électrique', 290, 0, 5, 'Autonomie de 480 km', 9),
(10, '500 Pop', 'Voiture', 10, 2023, 4.7, 15000, '3571x1627x1488', 'Essence', 69, 5.1, 4, 'Intérieur personnalisable', 10),
(11, 'Panda Cross', 'Voiture', 11, 2023, 4.6, 18000, '3999x1714x1667', 'Essence', 85, 5, 4, 'Système de navigation Uconnect', 11),
(12, 'Tipo Lounge', 'Voiture', 12, 2023, 4.5, 20000, '4500x1796x1495', 'Diesel', 120, 4.5, 5, 'Climatisation automatique', 12),
(13, 'Micra Visia', 'Voiture', 13, 2023, 4.5, 16000, '3999x1743x1455', 'Essence', 71, 5.8, 5, 'Caméra de recul', 13),
(14, 'Juke N-Connecta', 'Voiture', 14, 2023, 4.8, 22000, '4210x1805x1595', 'Essence', 117, 6, 5, 'Système de navigation NissanConnect', 14),
(15, 'Qashqai Tekna', 'Voiture', 15, 2023, 4.7, 28000, '4394x1839x1590', 'Diesel', 150, 4.7, 5, 'Toit panoramique en verre', 15);

-- --------------------------------------------------------

--
-- Structure de la table `version`
--

DROP TABLE IF EXISTS `version`;
CREATE TABLE IF NOT EXISTS `version` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `annee` year DEFAULT NULL,
  `modele_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modele_id` (`modele_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `version`
--

INSERT INTO `version` (`id`, `nom`, `annee`, `modele_id`) VALUES
(1, 'LE', 2023, 1),
(2, 'Hybrid', 2023, 2),
(3, 'Adventure', 2023, 3),
(4, 'Zen', 2023, 4),
(5, 'Intens', 2023, 5),
(6, 'RS', 2023, 6),
(7, 'Trend', 2023, 7),
(8, 'Titanium', 2023, 8),
(9, 'Mach-E', 2023, 9),
(10, 'Pop', 2023, 10),
(11, 'Cross', 2023, 11),
(12, 'Lounge', 2023, 12),
(13, 'Visia', 2023, 13),
(14, 'N-Connecta', 2023, 14),
(15, 'Tekna', 2023, 15),
(16, 'LE', 2024, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
