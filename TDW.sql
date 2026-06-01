-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 jan. 2024 à 00:35
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
  `type` int DEFAULT NULL,
  `target_id` int DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  `statut` enum('valide','refuse','en attente') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `commentaire`, `note`, `type`, `target_id`, `utilisateur_id`, `statut`) VALUES
(23, 'test', 4, 0, 1, 3, 'valide'),
(2, 'Comfortable seats.', 4, 0, 1, 2, 'en attente'),
(3, 'Best in class safety features.', 3, 0, 1, 3, 'valide'),
(4, 'Great car!', 4.5, 0, 1, 1, 'valide'),
(6, 'Excellent brand!', 4.8, 1, 1, 3, 'valide'),
(7, 'Average performance.', 3, 1, 2, 4, 'valide'),
(8, 'Good driving experience.', 4.6, 0, 3, 5, 'en attente'),
(22, 'test2', 1, 0, 1, 3, 'valide'),
(10, 'Needs improvement in fuel efficiency.', 3.2, 0, 2, 2, 'en attente'),
(11, 'Excellent brand!', 4.8, 1, 1, 3, 'valide'),
(12, 'Average performance.', 3, 1, 2, 4, 'valide'),
(14, 'I love this vehicule', 5, 0, 1, 3, 'valide'),
(15, 'I love this vehicule', 5, 0, 1, 3, 'valide'),
(16, 'baaaaaad', 1, 0, 1, 3, 'valide');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comparaison`
--

INSERT INTO `comparaison` (`id`, `vehicule1`, `vehicule2`, `nb`) VALUES
(1, 1, 2, 4),
(2, 2, 3, 6),
(3, 1, 4, 11),
(4, 2, 5, 21),
(5, 3, 4, 1),
(6, 1, 7, 2),
(7, 1, 8, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conseil`
--

INSERT INTO `conseil` (`id`, `titre`, `contenu`, `image_id`) VALUES
(1, 'Conseils d\'entretien', 'Prendre soin de votre véhicule est essentiel pour assurer sa longévité et maintenir ses performances optimales. Les conseils d\'entretien appropriés peuvent également vous faire économiser de l\'argent à long terme en évitant des réparations coûteuses. Voici quelques recommandations pour vous aider à maintenir votre véhicule en excellent état.\n\nChangement Régulier de l\'Huile\nL\'huile moteur est le sang de votre voiture. Assurez-vous de respecter les intervalles recommandés pour le changement d\'huile, en utilisant une huile de qualité adaptée à votre véhicule. Cela garantira une lubrification optimale du moteur, réduira l\'usure et améliorera l\'efficacité énergétique.\n\nContrôlez et Remplacez le Filtre à Air\nUn filtre à air propre est essentiel pour le bon fonctionnement du moteur. Vérifiez régulièrement le filtre à air et remplacez-le si nécessaire. Un filtre à air propre favorise une meilleure combustion et réduit la consommation de carburant.\n\nVérification des Niveaux de Liquides\nSurveillez régulièrement les niveaux de liquides tels que l\'antigel, le liquide de frein, et le liquide de direction assistée. Les niveaux inadéquats peuvent causer des problèmes majeurs. Assurez-vous de suivre les recommandations du fabricant pour les intervalles de vérification et de remplacement.\n\nInspection des Freins\nLes freins sont cruciaux pour votre sécurité. Effectuez régulièrement une inspection visuelle des plaquettes et des disques de frein. Remplacez-les si vous constatez une usure excessive. Un système de freinage en bon état est essentiel pour des arrêts sûrs et efficaces.\n\nRotation des Pneus\nLa rotation régulière des pneus contribue à une usure uniforme, prolongeant ainsi leur durée de vie. Consultez le manuel du propriétaire pour connaître les intervalles recommandés. N\'oubliez pas de vérifier la pression des pneus régulièrement pour une conduite optimale et une économie de carburant.\n\nSuivi du Carnet d\'Entretien\nChaque véhicule est livré avec un carnet d\'entretien spécifique du fabricant. Suivez attentivement ce carnet et effectuez les services recommandés. Cela contribuera à maintenir la garantie du véhicule et à prévenir les problèmes mécaniques.\n\nConclusion\nEn suivant ces conseils d\'entretien, vous investissez dans la durée de vie et les performances de votre véhicule. Prenez le temps de vous occuper de votre voiture, et elle vous le rendra par des années de conduite fiable. En cas de doute, consultez toujours un professionnel de l\'entretien automobile pour des conseils spécifiques à votre véhicule.', 21),
(2, 'Choisir le bon modèle', 'Introduction\nChoisir le bon modèle de véhicule est une décision importante qui peut avoir un impact significatif sur votre vie quotidienne. Que vous recherchiez une voiture, un SUV, un camion ou une voiture électrique, ce guide vous aidera à évaluer vos besoins et à prendre une décision éclairée.\n\nÉvaluation de vos Besoins\n1. Taille et Capacité\nDéterminez combien d\'espace vous avez besoin en termes de passagers et de cargaison. Si vous avez une famille nombreuse, un SUV ou un monospace peut être plus adapté. Si vous n\'avez besoin que d\'un véhicule pour vous déplacer en ville, une berline compacte pourrait suffire.\n\n2. Type de Conduite\nRéfléchissez à la manière dont vous prévoyez d\'utiliser votre véhicule. Si vous conduisez principalement en ville, une voiture compacte peut être plus pratique. Si vous avez besoin de capacités tout-terrain, un SUV ou un 4x4 pourrait être la meilleure option.\n\n3. Économie de Carburant\nSi l\'efficacité énergétique est importante pour vous, considérez des modèles plus écoénergétiques, tels que les hybrides ou les véhicules électriques. Évaluer la consommation de carburant par rapport à vos habitudes de conduite peut vous aider à économiser sur les coûts de carburant à long terme.\n\nBudget et Coûts Associés\n1. Prix d\'Achat\nÉtablissez un budget réaliste pour l\'achat de votre véhicule. N\'oubliez pas de prendre en compte les coûts supplémentaires tels que les taxes, les frais d\'immatriculation et les assurances.\n\n2. Coûts d\'Entretien\nCertains modèles peuvent être plus coûteux à entretenir que d\'autres. Renseignez-vous sur les coûts d\'entretien prévus, y compris les pièces détachées et la main-d\'œuvre, avant de prendre votre décision.\n\n3. Dépréciation\nLa dépréciation est inévitable, mais certaines voitures perdent de la valeur plus rapidement que d\'autres. Consultez les évaluations de la dépréciation des modèles qui vous intéressent.\n\nFonctionnalités et Options\n1. Sécurité\nVérifiez les fonctionnalités de sécurité offertes par le modèle, telles que les systèmes d\'assistance à la conduite, les airbags, et les dispositifs de freinage d\'urgence.\n\n2. Confort et Technologie\nExplorez les options de confort et de technologie disponibles, telles que les sièges chauffants, les systèmes de navigation, et les capacités de connectivité.\n\n3. Options de Personnalisation\nCertains modèles offrent des options de personnalisation qui vous permettent de choisir des caractéristiques spécifiques en fonction de vos préférences.\n\nEssai Routier et Avis des Propriétaires\nAvant de prendre votre décision finale, planifiez des essais routiers pour les modèles qui correspondent à vos critères. Consultez également les avis des propriétaires en ligne pour obtenir des perspectives réelles sur la fiabilité et la satisfaction des clients.\n\nConclusion\nEn choisissant le bon modèle de véhicule, vous pouvez maximiser votre satisfaction à long terme. Prenez le temps de réfléchir à vos besoins, de comparer les options et de faire des recherches approfondies. En fin de compte, le modèle qui correspond le mieux à vos exigences individuelles sera celui qui vous offrira une expérience de conduite optimale.', 22),
(3, 'Les Étapes Essentielles', 'Introduction\nL\'achat d\'un véhicule est une décision importante qui nécessite une planification minutieuse. Que vous optiez pour une voiture neuve ou d\'occasion, ce guide d\'achat vous guidera à travers les étapes essentielles pour vous assurer de faire le meilleur choix.\n\nDéfinir Vos Besoins\n1. Analyser Votre Style de Vie\nÉvaluez votre quotidien, y compris la distance que vous parcourez, le nombre de passagers que vous transportez régulièrement, et vos habitudes de conduite. Ces facteurs influenceront le type de véhicule qui vous convient le mieux.\n\n2. Déterminer le Budget\nÉtablissez un budget réaliste en prenant en compte le coût d\'achat du véhicule, les frais d\'immatriculation, les taxes, l\'assurance, et les coûts d\'entretien. Cela vous aidera à définir la fourchette de prix à laquelle vous devriez vous limiter.\n\n3. Nouveau ou d\'Occasion\nDécidez si vous souhaitez acheter un véhicule neuf ou d\'occasion. Les deux options ont leurs avantages et leurs inconvénients, il est donc important de peser le coût initial par rapport à la dépréciation et à l\'historique d\'entretien.\n\nRecherche Approfondie\n1. Consultez les Avis en Ligne\nLisez les avis en ligne sur les modèles qui suscitent votre intérêt. Les expériences d\'autres propriétaires peuvent fournir des informations précieuses sur la fiabilité, les performances et la satisfaction générale.\n\n2. Comparez les Modèles\nComparez les caractéristiques, les performances, la consommation de carburant et les coûts d\'entretien de plusieurs modèles dans la catégorie qui correspond à vos besoins. Cela vous aidera à affiner vos choix.\n\n3. Vérifiez les Cotes de Sécurité\nConsultez les cotes de sécurité des véhicules auprès d\'organismes tels que l\'IIHS (Insurance Institute for Highway Safety) et la NHTSA (National Highway Traffic Safety Administration) pour vous assurer que le modèle choisi répond aux normes de sécurité.\n\nEssai Routier\n1. Planifiez des Essais Routiers\nPrenez rendez-vous pour des essais routiers avec les modèles qui ont retenu votre attention. Assurez-vous de tester divers aspects tels que la conduite, le confort, la visibilité et la maniabilité.\n\n2. Posez des Questions\nLors de l\'essai routier, posez des questions au concessionnaire sur les caractéristiques spécifiques du modèle, les garanties, et les options de financement disponibles.\n\nNégociation et Financement\n1. Étudiez les Options de Financement\nExplorez les options de financement disponibles, que ce soit un prêt automobile, la location ou le paiement au comptant. Comparez les taux d\'intérêt et les conditions pour obtenir la meilleure offre.\n\n2. Négociez le Prix\nSoyez prêt à négocier le prix avec le vendeur. Faites des recherches sur la valeur marchande du véhicule et soyez prêt à compromettre pour parvenir à un accord équitable.\n\nVérification Pré-Achat\n1. Historique du Véhicule d\'Occasion\nSi vous envisagez d\'acheter un véhicule d\'occasion, obtenez un rapport d\'historique du véhicule pour vérifier s\'il a été impliqué dans des accidents ou s\'il a des problèmes mécaniques.\n\n2. Inspection Mécanique\nFaites inspecter le véhicule par un mécanicien qualifié pour identifier tout problème potentiel. Cela peut vous éviter des surprises désagréables après l\'achat.\n\nConclusion\nEn suivant ces étapes, vous serez mieux préparé pour faire un choix éclairé lors de l\'achat de votre véhicule. Prenez le temps de rechercher, de poser des questions et de négocier judicieusement pour vous assurer de faire un investissement qui répond à vos besoins et à votre budget.\n\n\n\n\n\nIntroduction\nL\'achat d\'un véhicule est une décision importante qui nécessite une planification minutieuse. Que vous optiez pour une voiture neuve ou d\'occasion, ce guide d\'achat vous guidera à travers les étapes essentielles pour vous assurer de faire le meilleur choix.\n\nDéfinir Vos Besoins\n1. Analyser Votre Style de Vie\nÉvaluez votre quotidien, y compris la distance que vous parcourez, le nombre de passagers que vous transportez régulièrement, et vos habitudes de conduite. Ces facteurs influenceront le type de véhicule qui vous convient le mieux.\n\n2. Déterminer le Budget\nÉtablissez un budget réaliste en prenant en compte le coût d\'achat du véhicule, les frais d\'immatriculation, les taxes, l\'assurance, et les coûts d\'entretien. Cela vous aidera à définir la fourchette de prix à laquelle vous devriez vous limiter.\n\n3. Nouveau ou d\'Occasion\nDécidez si vous souhaitez acheter un véhicule neuf ou d\'occasion. Les deux options ont leurs avantages et leurs inconvénients, il est donc important de peser le coût initial par rapport à la dépréciation et à l\'historique d\'entretien.\n\nRecherche Approfondie\n1. Consultez les Avis en Ligne\nLisez les avis en ligne sur les modèles qui suscitent votre intérêt. Les expériences d\'autres propriétaires peuvent fournir des informations précieuses sur la fiabilité, les performances et la satisfaction générale.\n\n2. Comparez les Modèles\nComparez les caractéristiques, les performances, la consommation de carburant et les coûts d\'entretien de plusieurs modèles dans la catégorie qui correspond à vos besoins. Cela vous aidera à affiner vos choix.\n\n3. Vérifiez les Cotes de Sécurité\nConsultez les cotes de sécurité des véhicules auprès d\'organismes tels que l\'IIHS (Insurance Institute for Highway Safety) et la NHTSA (National Highway Traffic Safety Administration) pour vous assurer que le modèle choisi répond aux normes de sécurité.\n\nEssai Routier\n1. Planifiez des Essais Routiers\nPrenez rendez-vous pour des essais routiers avec les modèles qui ont retenu votre attention. Assurez-vous de tester divers aspects tels que la conduite, le confort, la visibilité et la maniabilité.\n\n2. Posez des Questions\nLors de l\'essai routier, posez des questions au concessionnaire sur les caractéristiques spécifiques du modèle, les garanties, et les options de financement disponibles.\n\nNégociation et Financement\n1. Étudiez les Options de Financement\nExplorez les options de financement disponibles, que ce soit un prêt automobile, la location ou le paiement au comptant. Comparez les taux d\'intérêt et les conditions pour obtenir la meilleure offre.\n\n2. Négociez le Prix\nSoyez prêt à négocier le prix avec le vendeur. Faites des recherches sur la valeur marchande du véhicule et soyez prêt à compromettre pour parvenir à un accord équitable.\n\nVérification Pré-Achat\n1. Historique du Véhicule d\'Occasion\nSi vous envisagez d\'acheter un véhicule d\'occasion, obtenez un rapport d\'historique du véhicule pour vérifier s\'il a été impliqué dans des accidents ou s\'il a des problèmes mécaniques.\n\n2. Inspection Mécanique\nFaites inspecter le véhicule par un mécanicien qualifié pour identifier tout problème potentiel. Cela peut vous éviter des surprises désagréables après l\'achat.\n\nConclusion\nEn suivant ces étapes, vous serez mieux préparé pour faire un choix éclairé lors de l\'achat de votre véhicule. Prenez le temps de rechercher, de poser des questions et de négocier judicieusement pour vous assurer de faire un investissement qui répond à vos besoins et à votre budget.\n\n\n\n\nGuide d\'Achat de Véhicule : Les Étapes Essentielles\nIntroduction\nL\'achat d\'un véhicule est une décision importante qui nécessite une planification minutieuse. Que vous optiez pour une voiture neuve ou d\'occasion, ce guide d\'achat vous guidera à travers les étapes essentielles pour vous assurer de faire le meilleur choix.\n\nDéfinir Vos Besoins\n1. Analyser Votre Style de Vie\nÉvaluez votre quotidien, y compris la distance que vous parcourez, le nombre de passagers que vous transportez régulièrement, et vos habitudes de conduite. Ces facteurs influenceront le type de véhicule qui vous convient le mieux.\n\n2. Déterminer le Budget\nÉtablissez un budget réaliste en prenant en compte le coût d\'achat du véhicule, les frais d\'immatriculation, les taxes, l\'assurance, et les coûts d\'entretien. Cela vous aidera à définir la fourchette de prix à laquelle vous devriez vous limiter.\n\n3. Nouveau ou d\'Occasion\nDécidez si vous souhaitez acheter un véhicule neuf ou d\'occasion. Les deux options ont leurs avantages et leurs inconvénients, il est donc important de peser le coût initial par rapport à la dépréciation et à l\'historique d\'entretien.\n\nRecherche Approfondie\n1. Consultez les Avis en Ligne\nLisez les avis en ligne sur les modèles qui suscitent votre intérêt. Les expériences d\'autres propriétaires peuvent fournir des informations précieuses sur la fiabilité, les performances et la satisfaction générale.\n\n2. Comparez les Modèles\nComparez les caractéristiques, les performances, la consommation de carburant et les coûts d\'entretien de plusieurs modèles dans la catégorie qui correspond à vos besoins. Cela vous aidera à affiner vos choix.\n\n3. Vérifiez les Cotes de Sécurité\nConsultez les cotes de sécurité des véhicules auprès d\'organismes tels que l\'IIHS (Insurance Institute for Highway Safety) et la NHTSA (National Highway Traffic Safety Administration) pour vous assurer que le modèle choisi répond aux normes de sécurité.\n\nEssai Routier\n1. Planifiez des Essais Routiers\nPrenez rendez-vous pour des essais routiers avec les modèles qui ont retenu votre attention. Assurez-vous de tester divers aspects tels que la conduite, le confort, la visibilité et la maniabilité.\n\n2. Posez des Questions\nLors de l\'essai routier, posez des questions au concessionnaire sur les caractéristiques spécifiques du modèle, les garanties, et les options de financement disponibles.\n\nNégociation et Financement\n1. Étudiez les Options de Financement\nExplorez les options de financement disponibles, que ce soit un prêt automobile, la location ou le paiement au comptant. Comparez les taux d\'intérêt et les conditions pour obtenir la meilleure offre.\n\n2. Négociez le Prix\nSoyez prêt à négocier le prix avec le vendeur. Faites des recherches sur la valeur marchande du véhicule et soyez prêt à compromettre pour parvenir à un accord équitable.\n\nVérification Pré-Achat\n1. Historique du Véhicule d\'Occasion\nSi vous envisagez d\'acheter un véhicule d\'occasion, obtenez un rapport d\'historique du véhicule pour vérifier s\'il a été impliqué dans des accidents ou s\'il a des problèmes mécaniques.\n\n2. Inspection Mécanique\nFaites inspecter le véhicule par un mécanicien qualifié pour identifier tout problème potentiel. Cela peut vous éviter des surprises désagréables après l\'achat.\n\nConclusion\nEn suivant ces étapes, vous serez mieux préparé pour faire un choix éclairé lors de l\'achat de votre véhicule. Prenez le temps de rechercher, de poser des questions et de négocier judicieusement pour vous assurer de faire un investissement qui répond à vos besoins et à votre budget.', 77);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `vehicule_id`, `utilisateur_id`) VALUES
(1, 1, 1),
(11, 1, 3),
(7, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lien` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(27, 'img/nissan.jpg'),
(28, 'img/news1_1.jpg'),
(29, 'img/Bentley.png'),
(30, 'img/Audi.png'),
(31, 'img/Hyundai.png'),
(32, 'img/Mercedes-Benz.png'),
(33, 'img/user.png'),
(34, 'img/parameter.png'),
(35, 'img/avis.png'),
(36, 'img/news.png'),
(37, 'img/vehicule.png'),
(77, 'img/conseil3.jpg');

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `nom`, `pays_origine`, `siege_social`, `annee_creation`, `lien`, `image_id`) VALUES
(2, 'Renault', 'France', 'Boulogne-Billancourt', 1898, 'https://www.renault.dz/', 24),
(3, 'Ford', 'USA', 'Dearborn', 1903, 'https://www.ford.com/', 25),
(4, 'Fiat', 'Italie', 'Turin', 1899, 'https://www.fiat.dz/', 26),
(5, 'Nissan', 'Japon', 'Yokohama', 1933, 'https://www.nissan.fr/', 27),
(6, 'Bentley', 'United Kingdom', 'Crewe, England', 1919, 'https://www.bentleymotors.com/', 29),
(7, 'Audi', 'Germany', 'Ingolstadt, Germany', 1909, 'https://www.audi.com', 30),
(8, 'Hyundai', 'South Korea', 'Seoul, South Korea', 1967, 'https://www.hyundai.com/fr/fr.html', 31),
(9, 'Mercedes-Benz', 'Germany', 'Stuttgart, Germany', 1926, 'https://www.mercedes-benz.com/', 32),
(1, 'Toyota', 'Japon', 'Toyota', 1937, 'https://www.toyota.com/', 23);

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` text,
  `date` date DEFAULT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `diapo` tinyint(1) DEFAULT NULL,
  `image_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `titre`, `contenu`, `date`, `lien`, `diapo`, `image_id`) VALUES
(1, 'Mazda prévoit lancer 7 ou 8 véhicules électriques d’ici 2030', 'La course à l’électrification est commencée, et Mazda compte bien retirer une part du gâteau. Même s’il semble prendre du temps à commercialiser des véhicules électriques sur notre marché, le constructeur a réitéré récemment, par la bouche de son PDG en entrevue avec Automotive News, de le faire dans les prochaines années. Selon son propos, on peut s’attendre à 7 ou 8 produits entièrement électriques d’ici 2030.', '2023-12-12', 'https://www.msn.com/fr-ca/style-de-vie/tendances/mazda-pr%C3%A9voit-lancer-7-ou-8-v%C3%A9hicules-%C3%A9lectriques-d-ici-2030/ar-AA1loSDj', 1, 16),
(2, 'UN VÉHICULE D’INTERVENTION DE 666 CHEVAUX POUR LA POLICE ITALIENNE !', '666 chevaux sous le capot pour une équipe d’intervention de la police ? C’est le cadeau de Noël en avance de Lamborghini aux forces de l’ordre italiennes.\n\nFruit d’une collaboration qui perdure depuis 20 ans, Lamborghini a livré un nouveau véhicule à la police routière italienne dans une cérémonie organisée le 12 décembre devant le siège du ministère de l’Intérieur, Piazza del Viminale à Rome.', '2023-12-11', 'https://www.autojournal.fr/actu/insolites-actu/vehicule-intervention-666-chevaux-police-italie-lamborghini-urus-performante-2024-nouveaute-323895.html', 1, 17),
(3, 'Nouvelle technologie de batteries révolutionnaires pour voitures électriques', 'Une équipe de chercheurs a développé une nouvelle technologie de batteries qui promet d\'augmenter considérablement l\'autonomie des voitures électriques. Cette avancée pourrait révolutionner l\'industrie automobile et accélérer la transition vers les véhicules électriques.', '2023-12-10', 'https://www.frandroid.com/survoltes/voitures-electriques/1750459_voici-la-nouvelle-batterie-revolutionnaire-des-voitures-electriques-peugeot-citroen-fiat-opel-et-jeep', 1, 18),
(4, 'Le marché des SUV en plein essor avec de nouveaux modèles attendus en 2024', 'Les SUV continuent de gagner en popularité, et plusieurs constructeurs annoncent de nouveaux modèles pour l\'année 2024. Ces véhicules offriront des fonctionnalités avancées, un design élégant et des performances améliorées.', '2023-12-09', 'https://www.autoplus.fr/actualite/suv-voici-les-modeles-stars-de-2024-1139081.html', 1, 19),
(5, 'Essai routier exclusif du dernier modèle de voiture autonome', 'Nous avons eu l\'occasion de tester en exclusivité le dernier modèle de voiture autonome. Découvrez nos impressions sur la conduite sans intervention humaine et les avancées technologiques qui rendent cela possible.', '2023-12-08', 'https://www.automobile-propre.com/essai-tesla-model-3-grande-autonomie-prise-en-main-exclusive-highland/', 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `news_details`
--

DROP TABLE IF EXISTS `news_details`;
CREATE TABLE IF NOT EXISTS `news_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` text,
  `image_id` int DEFAULT NULL,
  `news_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news_details`
--

INSERT INTO `news_details` (`id`, `text`, `image_id`, `news_id`) VALUES
(1, 'La vision qu’a Masahiro Moro. actuel PDG de Mazda et ancien PDG de Mazda pour l’Amérique du Nord, repose essentiellement sur une architecture unique sur laquelle une équipe de près de 100 personnes est en train de travailler. Cette architecture sera modulable et sous-tendra les produits que lancera le constructeur d’ici 2030. Le constructeur estime que 25 % à 40 % des véhicules vendus seront électriques en 2030, se gardant d’être plus précis compte tenu de l’instabilité du marché actuel.', 18, 1),
(2, 'La légèreté, et la rentabilité.\nLe principe de base qu’il met à l’avant-plan est l’efficacité et la légèreté. C’est, selon lui, la seule avenue pour rendre les véhicules électriques logiques, du point de vue financier. Même s’il n’a pas voulu confirmer les détails mécaniques, notamment parce qu’il estime qu’il peut se passer beaucoup de choses d’ici l’arrivée prévue en 2025, Masahiro Moro mentionne que le constructeur évalue actuellement ses options. Il envisage des moteurs électriques plus puissants et moins puissants, qui pourraient être disponibles en formule à un ou deux moteurs. L’une des préoccupations semble la taille de la batterie, parce qu’une plus grande capacité équivaut automatiquement à un prix et un poids plus élevés.Selon lui, Mazda essaiera de se différencier des autres constructeurs. Alors que nous voyons actuellement beaucoup de VUS à la ligne de toit surbaissée, pour améliorer le coefficient de pénétration dans l’air, Mazda tentera vraisemblablement de continuer à adopter une forme typique de VUS, très verticale. Des 7 ou 8 produits prévus, rien n’indique quelle quantité sera vendue chez nous.\n\nPour finir, pour améliorer la rentabilité et séparer les coûts de fabrication, Mazda travaillera avec Toyota pour l’architecture logicielle et électronique de ses véhicules électriques. Selon Moro, les composants matériels demeureront individuels pour les deux marques, mais le partage des logiciels, pour ces produits aussi importants, permettra de limiter de 70 % à 80 % l’investissement total pour l’électrification de la gamme.', 28, 1);

-- --------------------------------------------------------

--
-- Structure de la table `parameters`
--

DROP TABLE IF EXISTS `parameters`;
CREATE TABLE IF NOT EXISTS `parameters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `image_id` int DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `param` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `parameters`
--

INSERT INTO `parameters` (`id`, `nom`, `image_id`, `value`, `param`) VALUES
(10, 'marque', 37, NULL, 0),
(9, 'news', 36, NULL, 0),
(8, 'avis', 35, NULL, 0),
(7, 'parameter', 34, NULL, 0),
(6, 'user', 33, NULL, 0),
(11, 'contact_email', NULL, 'soundouus1@gmail.com', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `sexe`, `date_de_naissance`, `nom_utilisateur`, `mot_de_passe`, `email`, `role`, `statut`) VALUES
(1, 'Kouadri', 'Nada', 'F', '1990-05-15', 'ln_kouadri', 'mdp_nada', 'ln_kouadri@esi.dz', 'client', 'bloque'),
(2, 'Sansri', 'Ibtihel', 'F', '1987-08-22', 'ki_sansri', 'mdp_ibti', 'ki_sansri@email.com', 'client', 'valide'),
(3, 'Benni', 'Mohamed', 'M', '2001-02-10', 'km_benni', 'mdp_med', 'km_benni@email.com', 'client', 'bloque'),
(4, 'Kouadri', 'Taqiy', 'F', '1995-11-30', 'kt_kouadri', 'mdp_taqiy', 'kt_kouadri@email.com', 'client', 'bloque'),
(5, '', '', 'M', '1988-06-18', 'admin', 'admin', 'admin@email.com', 'admin', 'valide'),
(6, 'Benni', 'Belkis', 'F', '2002-10-14', 'Benni_Belkis', 'any', NULL, 'client', 'valide');

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
  `principale` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `version_id` (`version_id`),
  KEY `fk_image_id` (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `nom`, `categorie`, `image_id`, `annee`, `note`, `tarif`, `dimensions`, `moteur`, `puissance`, `consommation`, `capacite`, `autre_performances`, `version_id`, `principale`) VALUES
(2, 'Prius Hybrid', 'Voiture', 2, 2023, 4.8, 30000, '4600x1760x1490', 'Hybride', 120, 5, 5, 'Consommation mixte 4.5 l/100km', 2, 1),
(3, 'RAV4 Adventure', 'Voiture', 3, 2023, 4.7, 35000, '4655x1855x1700', 'Essence', 203, 8.3, 5, 'Transmission intégrale', 3, 0),
(4, 'Clio Zen', 'Voiture', 4, 2023, 4.5, 18000, '4050x1798x1440', 'Essence', 90, 6, 5, 'Écran tactile 7 pouces', 4, 1),
(5, 'Captur Intens', 'Voiture', 5, 2023, 4.8, 22000, '4227x1778x1576', 'Essence', 130, 6.5, 5, 'Toit panoramique en verre', 5, 1),
(6, 'Megane RS', 'Voiture', 6, 2023, 4.7, 35000, '4371x1871x1447', 'Essence', 300, 7, 5, 'Châssis sport', 6, 0),
(7, 'Fiesta Trend', 'Voiture', 7, 2023, 4.6, 17000, '4040x1735x1476', 'Essence', 85, 5.8, 5, 'Système de son Bang & Olufsen', 7, 1),
(8, 'Focus Titanium', 'Voiture', 8, 2023, 4.9, 24000, '4378x1825x1454', 'Essence', 150, 6.5, 5, 'Sièges en cuir chauffants', 8, 1),
(9, 'Mustang Mach-E', 'Voiture', 9, 2023, 4.8, 50000, '4732x1882x1614', 'Électrique', 290, 0, 5, 'Autonomie de 480 km', 9, 0),
(10, '500 Pop', 'Voiture', 10, 2023, 4.7, 15000, '3571x1627x1488', 'Essence', 69, 5.1, 4, 'Intérieur personnalisable', 10, 1),
(11, 'Panda Cross', 'Voiture', 11, 2023, 4.6, 18000, '3999x1714x1667', 'Essence', 85, 5, 4, 'Système de navigation Uconnect', 11, 1),
(12, 'Tipo Lounge', 'Voiture', 12, 2023, 4.5, 20000, '4500x1796x1495', 'Diesel', 120, 4.5, 5, 'Climatisation automatique', 12, 0),
(13, 'Micra Visia', 'Voiture', 13, 2023, 4.5, 16000, '3999x1743x1455', 'Essence', 71, 5.8, 5, 'Caméra de recul', 13, 1),
(14, 'Juke N-Connecta', 'Voiture', 14, 2023, 4.8, 22000, '4210x1805x1595', 'Essence', 117, 6, 5, 'Système de navigation NissanConnect', 14, 1),
(15, 'Qashqai Tekna', 'Voiture', 15, 2023, 4.7, 28000, '4394x1839x1590', 'Diesel', 150, 4.7, 5, 'Toit panoramique en verre', 15, 0),
(1, 'Corolla LE', 'Voiture', 1, 2023, 4.5, 25000, '4500x1800x1600', 'Essence', 150, 7.5, 5, 'Acceleration 0-100 km/h en 8.2s', 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
