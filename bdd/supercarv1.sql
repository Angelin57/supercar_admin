-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 01 juin 2024 à 21:12
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `supercar`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `log_login` (IN `user` VARCHAR(255))   BEGIN
    INSERT INTO login_logs (username, login_time) VALUES (user, CURRENT_TIMESTAMP);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `acceuil`
--

CREATE TABLE `acceuil` (
  `id_acceuil` int(11) NOT NULL,
  `libelle_1` text DEFAULT NULL,
  `libelle_2` varchar(50) DEFAULT NULL,
  `libelle_3` varchar(50) DEFAULT NULL,
  `libelle_4` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `acceuil`
--

INSERT INTO `acceuil` (`id_acceuil`, `libelle_1`, `libelle_2`, `libelle_3`, `libelle_4`) VALUES
(1, 'L’équipe SuperCar vous propose une toute nouvelle gamme de voitures selon votre choix avec un essai gratuit, assurance et entretien automobile déjà effectués avec notre gestionnaire mécanique expérimenté. Nous vous offrons une garantie sur tous les éléments et pièces du véhicule en cas de panne, pendant 6 mois à compter de la date d’achat. Nous vous remercions de votre collaboration et de votre confiance.', 'DISPONIBLE 24H/24 ET 7J/7', 'RESERVATION À TOUT MOMENT', 'VOITURE GARANTIE ET ASSURANCE');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `mdp`) VALUES
(1, 'test', 'test'),
(3, 'angelin57', '1234'),
(4, 'fehizoroscania@gmail.com', 'dd441');

--
-- Déclencheurs `admin`
--
DELIMITER $$
CREATE TRIGGER `after_admin_update` AFTER UPDATE ON `admin` FOR EACH ROW BEGIN
    INSERT INTO admin_modifications (username, date_modification)
    VALUES ($username_utilisateur, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `admin_modifications`
--

CREATE TABLE `admin_modifications` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin_modifications`
--

INSERT INTO `admin_modifications` (`id`, `username`, `date_modification`) VALUES
(1, 'root@localhost', '2024-05-28 15:46:28'),
(2, '', '2024-05-28 15:47:15'),
(3, 'fehizoroscania@gmail.com', '2024-05-28 15:58:21'),
(4, '$username_utilisateur', '2024-05-28 16:12:12');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `objet` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `nom`, `mail`, `objet`, `message`) VALUES
(1, 'angelin', 'fehizoroscania@gmail.com', 'commande', 'achat'),
(2, 'fehizoro', 'actros@gmail.com', 'ddddddddddd', 'dddddddd');

-- --------------------------------------------------------

--
-- Structure de la table `dmdessai`
--

CREATE TABLE `dmdessai` (
  `id_dmdessai` int(11) NOT NULL,
  `civilite` varchar(100) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `heure` varchar(100) DEFAULT NULL,
  `marque` varchar(100) DEFAULT NULL,
  `v_nom` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `transmission` varchar(100) DEFAULT NULL,
  `statut` varchar(100) DEFAULT 'En cours',
  `id_voiture` int(11) NOT NULL,
  `idco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dmdessai`
--

INSERT INTO `dmdessai` (`id_dmdessai`, `civilite`, `nom`, `prenom`, `dates`, `heure`, `marque`, `v_nom`, `type`, `transmission`, `statut`, `id_voiture`, `idco`) VALUES
(62, 'M.', 'RAZAFINDRATSIMBA', 'Angelin', '2024-06-07', '9h-10h', 'test', 'test', 'camion', 'automatique', 'En cours', 41, 22);

-- --------------------------------------------------------

--
-- Structure de la table `image_voiture`
--

CREATE TABLE `image_voiture` (
  `id_image` int(11) NOT NULL,
  `sre` varchar(100) DEFAULT NULL,
  `id_voiture` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `image_voiture`
--

INSERT INTO `image_voiture` (`id_image`, `sre`, `id_voiture`) VALUES
(1, 'img/voitures/clio (1).jpeg', 13),
(2, 'img/voitures/clio (2).jpg', 13),
(3, 'img/voitures/clio (3).jpg', 13),
(4, 'img/voitures/clio (4).jpg', 13),
(5, 'img/voitures/clio (5).jpg', 13),
(6, 'img/voitures/crafter (1).jpeg', 7),
(7, 'img/voitures/crafter (2).jpg', 7),
(8, 'img/voitures/crafter (3).jpg', 7),
(9, 'img/voitures/crafter (4).jpg', 7),
(10, 'img/voitures/crafter (5).jpg', 7),
(11, 'img/voitures/crafter_1 (1).jpg', 11),
(12, 'img/voitures/crafter_1 (2).jpg', 11),
(13, 'img/voitures/crafter_1 (3).jpg', 11),
(14, 'img/voitures/crafter_1 (4).jpg', 11),
(15, 'img/voitures/crafter_1 (5).jpg', 11),
(16, 'img/voitures/crafter_1 (6).jpg', 11),
(18, 'img/voitures/focus (1).jpg', 18),
(19, 'img/voitures/focus (2).jpg', 18),
(20, 'img/voitures/focus (3).jpg', 18),
(21, 'img/voitures/focus (4).jpg', 18),
(22, 'img/voitures/golf (1).jpg', 14),
(23, 'img/voitures/golf (2).jpg', 14),
(24, 'img/voitures/golf (3).jpg', 14),
(25, 'img/voitures/golf (4).jpg', 14),
(26, 'img/voitures/golf (5).jpg', 14),
(27, 'img/voitures/hilux (1).jpg', 2),
(28, 'img/voitures/hilux (2).jpg', 2),
(29, 'img/voitures/hilux (3).jpg', 2),
(30, 'img/voitures/hilux (4).jpg', 2),
(31, 'img/voitures/hilux (5).jpg', 2),
(32, 'img/voitures/hilux (6).jpg', 2),
(33, 'img/voitures/man (1).jpg', 8),
(34, 'img/voitures/man (2).jpg', 8),
(35, 'img/voitures/man (3).jpg', 8),
(36, 'img/voitures/man (4).jpg', 8),
(37, 'img/voitures/man (5).jpg', 8),
(38, 'img/voitures/march (1).jpg', 17),
(39, 'img/voitures/march (2).jpg', 17),
(40, 'img/voitures/march (3).jpg', 17),
(41, 'img/voitures/march (4).jpg', 17),
(42, 'img/voitures/mazda (1).jpg', 4),
(43, 'img/voitures/mazda (2).jpg', 4),
(44, 'img/voitures/mazda (3).jpg', 4),
(45, 'img/voitures/mazda (4).jpg', 4),
(46, 'img/voitures/mazda (5).jpg', 4),
(47, 'img/voitures/mitsubishi (1).jpg', 1),
(48, 'img/voitures/mitsubishi (2).jpg', 1),
(49, 'img/voitures/mitsubishi (3).jpg', 1),
(50, 'img/voitures/mitsubishi (5).jpg', 1),
(51, 'img/voitures/mitsubishi (6).jpg', 1),
(52, 'img/voitures/mitsubishi (7).jpg', 1),
(53, 'img/voitures/navara (1).jpeg', 3),
(54, 'img/voitures/navara (2).jpeg', 3),
(55, 'img/voitures/navara (3).jpeg', 3),
(56, 'img/voitures/navara (4).jpeg', 3),
(57, 'img/voitures/navara (5).jpeg', 3),
(58, 'img/voitures/ranger (1).jpg', 6),
(59, 'img/voitures/ranger (2).jpg', 6),
(60, 'img/voitures/ranger (3).jpg', 6),
(61, 'img/voitures/ranger (4).jpg', 6),
(62, 'img/voitures/ranger (5).jpg', 6),
(63, 'img/voitures/ranger (6).jpg', 6),
(64, 'img/voitures/raptor (1).jpg', 5),
(65, 'img/voitures/raptor (2).jpg', 5),
(66, 'img/voitures/raptor (3).jpg', 5),
(67, 'img/voitures/raptor (4).jpg', 5),
(68, 'img/voitures/raptor (5).jpg', 5),
(69, 'img/voitures/raptor (6).jpg', 5),
(70, 'img/voitures/yaris (1).jpg', 16),
(71, 'img/voitures/yaris (2).jpg', 16),
(72, 'img/voitures/yaris (3).jpg', 16),
(73, 'img/voitures/yaris (4).jpg', 16),
(74, 'img/voitures/208_1 (1).jpg', 15),
(75, 'img/voitures/208_1 (2).jpg', 15),
(76, 'img/voitures/208_1 (3).jpg', 15),
(77, 'img/voitures/208_1 (4).jpg', 15),
(78, 'img/voitures/519 (1).jpg', 9),
(79, 'img/voitures/519 (2).jpg', 9),
(80, 'img/voitures/519 (3).jpg', 9),
(81, 'img/voitures/519 (4).jpg', 9),
(82, 'img/voitures/519l(2).jpg', 10),
(83, 'img/voitures/519l (1).jpg', 10),
(84, 'img/voitures/519l (3).jpg', 10),
(85, 'img/voitures/519l (4).jpg', 10),
(86, 'img/voitures/519ll (1).jpg', 12),
(87, 'img/voitures/519ll (2).jpg', 12),
(88, 'img/voitures/519ll (3).jpg', 12),
(89, 'img/voitures/519ll (4).jpg', 12),
(90, 'img/voitures/519ll (5).jpg', 12),
(91, 'img/voitures/mitsubishi (4).jpg', 1),
(107, 'img/voitures/651d1ec255809_actrosmp3.jpg', 35);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `idco` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `telephone` varchar(12) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `naissance` date DEFAULT NULL,
  `sexe` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`idco`, `nom`, `prenom`, `mail`, `telephone`, `adresse`, `naissance`, `sexe`, `password`) VALUES
(22, 'RAZAFINDRATSIMBA', 'Angelin', 'test@gmail.com', '123456', 'fewfewew', '2024-05-17', 'Homme', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `login_logs`
--

INSERT INTO `login_logs` (`id`, `username`, `login_time`) VALUES
(1, 'test', '2024-05-31 15:06:36'),
(3, 'angelin57', '2024-05-31 15:10:59');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `libelle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id_service`, `titre`, `libelle`) VALUES
(1, 'LIVRAISION GRATUITE PARTOUT À MAURICE', 'Notre équipe s\'engage à vous livrer votre voiture en toute sécurité si vous ne pouviez pas venir le recupérer vous-même.'),
(2, 'FACILITÉ DE PAIEMENT', 'Il est tout à fait possible de négocier pour trancher les versement et vous faciliter le paiement.'),
(3, 'GARANTIE SUPERCAR DE 6 MOIS', 'Si votre voiture subit une défaillance des pièces ou une panne pendant les six premiers mois, Supercar s\'engage à vous dépanner gratuitement.'),
(4, 'DEMANDE D\'ESSAI GRATUIT', 'Vous pouvez prendre rendez-vous gratuitement sur le site pour un essai de la voiture de votre choix, sans aucun frais.'),
(5, 'ENTRETIENT GRATUITE', 'Six mois à compté de l\'achat de votre voiture, Supercar vous propose un entretient complet de votre voiture en plus d\'un lavage , et tout cela sans payer ne serais-ce qu\'un centime.'),
(6, 'CONSEILLER CLIENT', 'Notre équipe peut également vous fournir des conseils et des explications sur les voitures si vous en avez besoin.'),
(13, 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `stats_visites`
--

CREATE TABLE `stats_visites` (
  `id` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `date_visite` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `stats_visites`
--

INSERT INTO `stats_visites` (`id`, `ip`, `date_visite`) VALUES
(7, '::1', '2024-03-22'),
(8, '::1', '2024-05-28'),
(1, '::2', '2024-03-20'),
(6, '::3', '2024-03-22');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE `voiture` (
  `id_voiture` int(11) NOT NULL,
  `voiture_marque` varchar(255) DEFAULT NULL,
  `voiture_name` varchar(255) DEFAULT NULL,
  `voiture_transmission` varchar(255) DEFAULT NULL,
  `voiture_carburant` varchar(255) DEFAULT NULL,
  `voiture_type` varchar(255) DEFAULT NULL,
  `voiture_km` varchar(100) DEFAULT NULL,
  `voiture_puissance` varchar(100) DEFAULT NULL,
  `voiture_annee` int(11) DEFAULT NULL,
  `voiture_prix` varchar(100) DEFAULT NULL,
  `provenance` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`id_voiture`, `voiture_marque`, `voiture_name`, `voiture_transmission`, `voiture_carburant`, `voiture_type`, `voiture_km`, `voiture_puissance`, `voiture_annee`, `voiture_prix`, `provenance`) VALUES
(1, 'Mitsubishi', 'l200', 'automatique', 'diesel', 'pickup', '20 000km', '170ch', 2021, '400 000€', 'Thaïlande'),
(2, 'Toyota', 'hilux', 'automatique', 'diesel', 'pickup', '29 000km', '204ch', 2020, '500 000€', 'Japonais'),
(3, 'Nissan', 'navara', 'automatique', 'diesel', 'pickup', '40 000km', '180ch', 2019, '350 000€', 'Japonais'),
(4, 'Mazda', 'bt50', 'automatique', 'diesel', 'pickup', '15 000km', '190ch', 2021, '450 000Rs', 'Japonais'),
(5, 'Ford', 'raptor', 'automatique', 'essence', 'pickup', '10 000km', '292ch', 2022, '550 000€', 'Espagne'),
(6, 'Ford', 'ranger', 'automatique', 'diesel', 'pickup', '35 000km', '200ch', 2020, '250 000€', 'Australie'),
(7, 'Volkswagen', 'crafter', 'manuel', 'diesel', 'fourgon', '124 000km', '163ch', 2012, '200 000€', 'Allemagne'),
(8, 'Man', 'tge', 'automatique', 'diesel', 'fourgon', '98 000km', '190ch', 2015, '202 000€', 'Inde'),
(9, 'Mercedes-benz', 'sprinter', 'manuel', 'diesel', 'fourgon', '150 000km', '190ch', 2014, '250 000Rs', 'Allemagne'),
(10, 'Mercedes-benz', 'sprinter', 'automatique', 'diesel', 'fourgon', '94 000km', '180ch', 2015, '200 000€', 'Allemagne'),
(11, 'Volkswagen', 'crafter', 'automatique', 'diesel', 'fourgon', '106 000km', '136ch', 2013, '180 000€', 'Allemagne'),
(12, 'Mercedes-benz', 'sprinter', 'manuel', 'diesel', 'fourgon', '190 000km', '190ch', 2012, '230 000€', 'Allemagne'),
(13, 'Renault', 'clio', 'automatique', 'essence', 'cuv', '126 000km', '130ch', 2015, '190 000€', 'France'),
(14, 'Volkswagen', 'golf', 'manuel', 'diesel', 'cuv', '80  000km', '180ch', 2017, '125 000€', 'Allemagne'),
(15, 'Peugeot', '208', 'automatique', 'essence', 'cuv', '60  000km', '160ch', 2020, '150 000€', 'France'),
(16, 'Toyota', 'yaris', 'manuel', 'essence', 'cuv', '70  000km', '150ch', 2015, '130 000€', 'Japonais'),
(17, 'Nissan', 'march', 'automatique', 'essence', 'cuv', '110  000km', '130ch', 2013, '160 000€', 'Japonais'),
(18, 'Ford', 'focus', 'automatique', 'diesel', 'cuv', '88  000km', '140ch', 2016, '170 000€', 'Allemagne');

--
-- Déclencheurs `voiture`
--
DELIMITER $$
CREATE TRIGGER `admin_modification_trigger` AFTER UPDATE ON `voiture` FOR EACH ROW BEGIN
    DECLARE admin_username VARCHAR(100);
    
    -- Trouver le nom d'utilisateur de l'administrateur actuellement connecté
    SELECT username INTO admin_username FROM admin WHERE id_admin = SESSION_USER();
    
    -- Insérer les détails de la modification dans une table d'audit
    INSERT INTO admin_modifications (id_admin, action, table_name, timestamp)
    VALUES (admin_username, 'modification', 'voiture', NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_voiture` BEFORE INSERT ON `voiture` FOR EACH ROW BEGIN
    IF NEW.voiture_prix IS NULL OR NEW.voiture_prix = '' THEN
        SET NEW.voiture_prix = 'Sur demande';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `voiture_categorie`
--

CREATE TABLE `voiture_categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voiture_categorie`
--

INSERT INTO `voiture_categorie` (`id_categorie`, `nom_categorie`) VALUES
(1, 'cuv'),
(2, 'pickup'),
(3, 'fourgon'),
(5, 'SUV'),
(21, 'camion');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acceuil`
--
ALTER TABLE `acceuil`
  ADD PRIMARY KEY (`id_acceuil`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `admin_modifications`
--
ALTER TABLE `admin_modifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Index pour la table `dmdessai`
--
ALTER TABLE `dmdessai`
  ADD PRIMARY KEY (`id_dmdessai`),
  ADD KEY `id_voiture` (`id_voiture`),
  ADD KEY `idco` (`idco`);

--
-- Index pour la table `image_voiture`
--
ALTER TABLE `image_voiture`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`idco`);

--
-- Index pour la table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Index pour la table `stats_visites`
--
ALTER TABLE `stats_visites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_ip_date` (`ip`,`date_visite`);

--
-- Index pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`id_voiture`),
  ADD KEY `fk_voiture_voiture_categorie` (`voiture_type`(250));

--
-- Index pour la table `voiture_categorie`
--
ALTER TABLE `voiture_categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acceuil`
--
ALTER TABLE `acceuil`
  MODIFY `id_acceuil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `admin_modifications`
--
ALTER TABLE `admin_modifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `dmdessai`
--
ALTER TABLE `dmdessai`
  MODIFY `id_dmdessai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `image_voiture`
--
ALTER TABLE `image_voiture`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `idco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `stats_visites`
--
ALTER TABLE `stats_visites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `voiture`
--
ALTER TABLE `voiture`
  MODIFY `id_voiture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `voiture_categorie`
--
ALTER TABLE `voiture_categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
