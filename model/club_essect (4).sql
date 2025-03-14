-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 13 mars 2025 à 10:38
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `club_essect`
--

-- --------------------------------------------------------

--
-- Structure de la table `adhesion`
--

CREATE TABLE `adhesion` (
  `id_adhesion` int(11) NOT NULL,
  `id_membre` int(11) DEFAULT NULL,
  `id_club` int(11) DEFAULT NULL,
  `date_demande` date NOT NULL DEFAULT curdate(),
  `cv` varchar(255) NOT NULL,
  `statut` enum('en attente','accepté','refusé') DEFAULT 'en attente',
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` int(11) NOT NULL,
  `titre_article` varchar(255) NOT NULL,
  `date_article` date NOT NULL,
  `contenu_article` text NOT NULL,
  `tags_article` varchar(256) NOT NULL,
  `statut_article` varchar(60) NOT NULL,
  `image_article` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `budget`
--

CREATE TABLE `budget` (
  `id_budget` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `montant_init` decimal(10,0) NOT NULL,
  `mont_utilise` decimal(10,0) NOT NULL,
  `mont_rest` decimal(10,0) NOT NULL,
  `annee` int(11) DEFAULT NULL CHECK (`annee` < 2025 and 2020 < `annee`),
  `id_departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`) VALUES
(23, 'educatif'),
(24, 'advertissement'),
(26, 'it'),
(27, 'data'),
(33, 'sociale'),
(37, 'educatif'),
(38, '+-/*'),
(39, 'politique'),
(40, 'robotique'),
(41, 'robotique'),
(42, 'Informatique et Programmation'),
(43, 'religieux'),
(44, 'innovation'),
(45, 'hello');

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `id_club` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `descrip` text DEFAULT NULL,
  `date_creation` date NOT NULL,
  `type_club` varchar(20) DEFAULT NULL,
  `id_departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`id_club`, `nom`, `descrip`, `date_creation`, `type_club`, `id_departement`) VALUES
(1, 'Fahmologia', 'Le club Fahmologia, fondé en novembre 2022, est un espace dédié à la simplification et à la diffusion des connaissances académiques. À travers des capsules vidéo et des articles accessibles, il vise à rendre les concepts complexes plus compréhensibles et applicables pour tous les étudiants.', '0000-00-00', 'académique et éducat', NULL),
(2, '', NULL, '2022-02-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id_departement` int(11) NOT NULL,
  `nom_departement` varchar(100) NOT NULL,
  `descrip_departement` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

CREATE TABLE `depense` (
  `id_depense` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `montant` decimal(10,0) NOT NULL,
  `descrip_dep` text DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `nom_evenement` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `descri` text NOT NULL,
  `type_eve` varchar(100) NOT NULL,
  `autorisation` enum('en attente','autorisé','refusé') NOT NULL DEFAULT 'en attente',
  `id_admin` int(11) DEFAULT NULL,
  `id_departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `nom_m` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tel` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `id_departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id_partici` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `status_participation` varchar(30) NOT NULL,
  `date_participation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

CREATE TABLE `reunion` (
  `id_reunion` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `date_r` date NOT NULL,
  `lieu_r` varchar(10) NOT NULL,
  `sujet` text NOT NULL,
  `id_departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(100) NOT NULL,
  `prenom_utilisateur` varchar(100) NOT NULL,
  `email_utilisateur` varchar(150) NOT NULL,
  `password_utilisateur` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role_utilisateur` varchar(50) NOT NULL DEFAULT 'membre',
  `photo_utilisateur` text DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `validation_email_utilisateur` int(11) NOT NULL DEFAULT 0,
  `cv` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `email_utilisateur`, `password_utilisateur`, `username`, `role_utilisateur`, `photo_utilisateur`, `token`, `validation_email_utilisateur`, `cv`) VALUES
(1, 'sahli', 'salsabil', 'sahlisasabil@gmail.com', '$2y$10$Gg9sU2U.zT.tisa349m50uHJDgF2thoAplpYW2bO8y5GPnodBHreq', 'salsabil', 'membre', 'ph8.png', 'vPs8rFYLtCkeGAiuYLE4LBWn5', 0, ''),
(2, 'ben haj yahia', 'koussay', 'koussaybenhajyahia@gmail.com', '$2y$10$Xf44637WBqJeTPxFwIJI0OcWyBLa7m9WO4pCNVwZYzgOLgnxKgqbq', 'koussay', 'membre', 'ph1.png', '586Ka9Bmgefi8Ii0SgzQq6BPV', 0, ''),
(3, 'gaabeb', 'meriem', 'gaabebmariem@gmail.com', '$2y$10$PONxudZOcY1jGJ7MtBiAxufQBBYXF3nn4ZO4mUd/vmUuHL78QoVV6', 'meriem', 'membre', 'ph7.png', '0PRxEpA9GG6qMOMoEX129Ss8V', 0, ''),
(4, 'agerbi', 'yassmine', 'agerbiyassmine@gmail.com', '$2y$10$2dsrf2ENr91.cN2j4n9K1OnK.pM0dc40H4drG9uYFSaj/.RGSfTDi', 'yassmine', 'membre', 'ph6.png', 'gaoRk4zsNdGXxmoEob37seGVV', 0, ''),
(5, 'ben romthane', 'ritej', 'benromthaneritej@gmail.com', '$2y$10$9rAXmB/cfBNcSMfCouLeQOecpgkBzGucReqglM5PhLKxhekRDjrRS', 'ritej', 'membre', 'ph3.png', 'a0pGNj20t21SsZw9b0z8WPP9q', 0, ''),
(6, 'abdelli', 'oumaima', 'abdellioumaima@gmail.com', '$2y$10$Pc5km2IEFNdtrQc7EfvO7O.5aiJswJK2iLZuvLTAQfp0A.5mxMQnm', 'oumaima', 'membre', 'ph4.png', 'f4DmaLK1DvvqUX8ubYPRvV4aL', 0, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adhesion`
--
ALTER TABLE `adhesion`
  ADD PRIMARY KEY (`id_adhesion`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_club` (`id_club`),
  ADD KEY `fk_adhesion_admin` (`id_admin`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id_budget`),
  ADD KEY `id_club` (`id_club`),
  ADD KEY `fk_budget_departement` (`id_departement`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`),
  ADD KEY `fk_club_departement` (`id_departement`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Index pour la table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`id_depense`),
  ADD KEY `depense_ibfk_1` (`id_club`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `fk_depense_admin` (`id_admin`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `id_club` (`id_club`),
  ADD KEY `fk_evenement_admin` (`id_admin`),
  ADD KEY `fk_evenement_departement` (`id_departement`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD KEY `id_club` (`id_club`),
  ADD KEY `fk_membre_departement` (`id_departement`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id_partici`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_evenement` (`id_evenement`);

--
-- Index pour la table `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`id_reunion`),
  ADD KEY `id_club` (`id_club`),
  ADD KEY `fk_reunion_departement` (`id_departement`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adhesion`
--
ALTER TABLE `adhesion`
  MODIFY `id_adhesion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `budget`
--
ALTER TABLE `budget`
  MODIFY `id_budget` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `id_depense` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `id_partici` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reunion`
--
ALTER TABLE `reunion`
  MODIFY `id_reunion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adhesion`
--
ALTER TABLE `adhesion`
  ADD CONSTRAINT `adhesion_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE,
  ADD CONSTRAINT `adhesion_ibfk_2` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_adhesion_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL;

--
-- Contraintes pour la table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_budget_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`);

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `fk_club_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`);

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `depense_ibfk_1` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depense_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_depense_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL;

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evenement_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_evenement_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `fk_membre_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`),
  ADD CONSTRAINT `membre_ibfk_1` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`id_evenement`) REFERENCES `evenement` (`id_evenement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reunion`
--
ALTER TABLE `reunion`
  ADD CONSTRAINT `fk_reunion_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`),
  ADD CONSTRAINT `reunion_ibfk_1` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
