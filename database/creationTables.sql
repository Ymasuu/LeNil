-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 19 avr. 2023 à 20:49
-- Version du serveur :  8.0.32-0ubuntu0.20.04.2
-- Version de PHP : 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lenil`
--

-- --------------------------------------------------------

--
-- Structure de la table `ProduitsVendeur`
--

CREATE TABLE `ProduitsVendeur` (
  `id` int NOT NULL,
  `emailVendeur` varchar(100) NOT NULL,
  `QuantiteVendeur` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `NomImage` char(50) NOT NULL,
  `nom` char(100) NOT NULL,
  `description` text,
  `minidescription` varchar(200) NOT NULL,
  `categorie` enum('Informatique','Jeux pour enfant','Vêtement') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ProduitsVendeur`
--

INSERT INTO `ProduitsVendeur` (`id`, `emailVendeur`, `QuantiteVendeur`, `prix`, `NomImage`, `nom`, `description`, `minidescription`, `categorie`) VALUES
(1, 'magasin1@gmail.com', 100, '29.99', 'casque.png', 'Casque', 'Grâce à la nouvelle conception de son boîtier de commande audio USB et sa carte son intégrée, HyperX Cloud II amplifie l\'audio et la voix pour créer une expérience de jeu Hi-Fi optimale. Vous serez toujours certain de tout entendre. Vous accédez à un monde de détails que les autres gamers ne connaîtront jamais : le bruissement d\'une botte dans les feuilles, une course furtive dans une conduite. Les commandes indépendantes permettent de régler le volume de l\'écoute et le niveau du micro. Vous pouvez aussi activer le son Surround 7.1 ou le micro.', 'Casque bluetooth', 'Informatique'),
(2, 'magasin1@gmail.com', 150, '19.99', 'casquette.jpg', 'Casquette', 'Balinco Casquette d\'hélice colorée | Casquette d\'hélicoptère | Casquette de propulseur | Casquette de Baseball pour Adultes et Enfants - Taille Ajustable', 'Accessoire de mode', 'Vêtement'),
(3, 'magasin1@gmail.com', 200, '9.99', 'chaussette.jpg', 'Chaussette', NULL, 'Chaussette confortable', 'Vêtement'),
(4, 'magasin2@gmail.com', 150, '19.99', 'casquette.jpg', 'Casquette', NULL, 'Accessoire de mode', 'Vêtement'),
(5, 'magasin1@gmail.com', 55, '29.99', 'clavier.jpg', 'Clavier', NULL, 'Clavier de jeu', 'Informatique'),
(6, 'magasin1@gmail.com', 75, '149.99', 'ecran.jpg', 'Ecran', NULL, 'Ecran haute résolution', 'Informatique'),
(7, 'magasin1@gmail.com', 44, '14.99', 'hdmi.jpg', 'Câble Hdmi', NULL, 'Câble de connexion', 'Informatique'),
(8, 'magasin2@gmail.com', 65, '50.99', 'lego2.jpg', 'Lego City', NULL, 'Lego pour construire votre ville', 'Jeux pour enfant'),
(9, 'magasin2@gmail.com', 86, '45.99', 'lego_voiture.jpg', 'Lego Technic Voiture', NULL, 'Lego pour adulte', 'Jeux pour enfant'),
(10, 'magasin2@gmail.com', 26, '5.99', 'lunette_soleil.jpg', 'Lunette soleil', NULL, 'Accessoire de mode', 'Vêtement'),
(11, 'magasin2@gmail.com', 75, '24.99', 'manette.jpg', 'Manette', NULL, 'Manette de jeu', 'Informatique'),
(12, 'magasin2@gmail.com', 99, '699.99', 'ordi_portable.jpg', 'Ordinateur Portable', NULL, 'Ordinateur portable pour gamer', 'Informatique'),
(13, 'magasin1@gmail.com', 458, '5.99', 'playmobil.jpg', 'Playmobil 1.0', NULL, 'Pour vos enfants', 'Jeux pour enfant'),
(14, 'magasin1@gmail.com', 54, '6.99', 'playmobil2.jpeg', 'Playmobil 2.0', NULL, 'Pour vos enfants', 'Jeux pour enfant'),
(15, 'magasin1@gmail.com', 865, '13.99', 'souris.jpg', 'Souris', NULL, 'Souris de jeu', 'Informatique'),
(16, 'magasin1@gmail.com', 254, '949.99', 'tour.jpg', 'Tour PC', NULL, 'Ordinateur pour gamer', 'Informatique'),
(17, 'magasin1@gmail.com', 55, '29.99', 'claquette.jpg', 'Claquette', NULL, 'Chaussure d\'été', 'Vêtement');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ProduitsVendeur`
--
ALTER TABLE `ProduitsVendeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emailVendeur` (`emailVendeur`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ProduitsVendeur`
--
ALTER TABLE `ProduitsVendeur`
  ADD CONSTRAINT `ProduitsVendeur_ibfk_1` FOREIGN KEY (`emailVendeur`) REFERENCES `Compte` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
