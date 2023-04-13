-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 13 avr. 2023 à 16:32
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id` int NOT NULL,
  `numeroRue` varchar(255) NOT NULL,
  `nomRue` varchar(255) DEFAULT NULL,
  `codePostal` smallint NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `complementAdresse` varchar(255) DEFAULT NULL,
  `idCommande` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `adresse_commande_quantitecommande`
--

CREATE TABLE `adresse_commande_quantitecommande` (
  `idAdresse` int NOT NULL,
  `idCommande` int NOT NULL,
  `idQuantiteCommande` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a_commandecontientproduitvendeur`
--

CREATE TABLE `a_commandecontientproduitvendeur` (
  `idCommande` int NOT NULL,
  `idProduitVendeur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a_payepar`
--

CREATE TABLE `a_payepar` (
  `emailCompte` varchar(50) NOT NULL,
  `idMoyenPayment` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `caracteristique`
--

CREATE TABLE `caracteristique` (
  `id` int NOT NULL,
  `valeur` varchar(10) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `emailCompte` varchar(150) NOT NULL,
  `dateNaissance` date NOT NULL,
  `telephone` int NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `codePostal` smallint NOT NULL,
  `pays` varchar(50) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `idCommande` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `colis`
--

CREATE TABLE `colis` (
  `id` int NOT NULL,
  `longueur` smallint DEFAULT NULL,
  `hauteur` smallint DEFAULT NULL,
  `poids` smallint DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int NOT NULL,
  `totalPayer` int DEFAULT NULL,
  `modePayment` varchar(20) DEFAULT NULL,
  `datePayment` date DEFAULT NULL,
  `idColis` int DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `email` varchar(100) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `abonnement` bit(1) DEFAULT NULL,
  `signatureContratClient` bit(1) DEFAULT NULL,
  `signatureContratVendeur` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `numero` int NOT NULL,
  `texte` varchar(255) DEFAULT NULL,
  `emailCompte` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moyenpayment`
--

CREATE TABLE `moyenpayment` (
  `id` int NOT NULL,
  `modePayment` enum('paypal','cb') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nombrepanier`
--

CREATE TABLE `nombrepanier` (
  `id` int NOT NULL,
  `QuantitePanier` int NOT NULL,
  `idPanier` int DEFAULT NULL,
  `idProduitVendeur` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int NOT NULL,
  `HT` decimal(10,0) DEFAULT NULL,
  `TVA` decimal(10,0) DEFAULT NULL,
  `TTC` decimal(10,0) DEFAULT NULL,
  `idClient` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `idCaracteristique` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produitsvendeur`
--

CREATE TABLE `produitsvendeur` (
  `id` int NOT NULL,
  `QuantiteVendeur` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `idPanier` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quantitecommande`
--

CREATE TABLE `quantitecommande` (
  `id` int NOT NULL,
  `quantite` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recherche`
--

CREATE TABLE `recherche` (
  `motCle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `adresse_commande_quantitecommande`
--
ALTER TABLE `adresse_commande_quantitecommande`
  ADD PRIMARY KEY (`idAdresse`,`idCommande`,`idQuantiteCommande`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idQuantiteCommande` (`idQuantiteCommande`);

--
-- Index pour la table `a_commandecontientproduitvendeur`
--
ALTER TABLE `a_commandecontientproduitvendeur`
  ADD PRIMARY KEY (`idCommande`,`idProduitVendeur`),
  ADD KEY `idProduitVendeur` (`idProduitVendeur`);

--
-- Index pour la table `a_payepar`
--
ALTER TABLE `a_payepar`
  ADD PRIMARY KEY (`emailCompte`,`idMoyenPayment`),
  ADD KEY `idMoyenPayment` (`idMoyenPayment`);

--
-- Index pour la table `caracteristique`
--
ALTER TABLE `caracteristique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `emailCompte` (`emailCompte`);

--
-- Index pour la table `colis`
--
ALTER TABLE `colis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idColis` (`idColis`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `emailCompte` (`emailCompte`);

--
-- Index pour la table `moyenpayment`
--
ALTER TABLE `moyenpayment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nombrepanier`
--
ALTER TABLE `nombrepanier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produitsvendeur`
--
ALTER TABLE `produitsvendeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPanier` (`idPanier`);

--
-- Index pour la table `quantitecommande`
--
ALTER TABLE `quantitecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recherche`
--
ALTER TABLE `recherche`
  ADD PRIMARY KEY (`motCle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `adresse_commande_quantitecommande`
--
ALTER TABLE `adresse_commande_quantitecommande`
  ADD CONSTRAINT `adresse_commande_quantitecommande_ibfk_1` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`id`),
  ADD CONSTRAINT `adresse_commande_quantitecommande_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `adresse_commande_quantitecommande_ibfk_3` FOREIGN KEY (`idQuantiteCommande`) REFERENCES `quantitecommande` (`id`);

--
-- Contraintes pour la table `a_commandecontientproduitvendeur`
--
ALTER TABLE `a_commandecontientproduitvendeur`
  ADD CONSTRAINT `a_commandecontientproduitvendeur_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `a_commandecontientproduitvendeur_ibfk_2` FOREIGN KEY (`idProduitVendeur`) REFERENCES `produitsvendeur` (`id`);

--
-- Contraintes pour la table `a_payepar`
--
ALTER TABLE `a_payepar`
  ADD CONSTRAINT `a_payepar_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`),
  ADD CONSTRAINT `a_payepar_ibfk_2` FOREIGN KEY (`idMoyenPayment`) REFERENCES `moyenpayment` (`id`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idColis`) REFERENCES `colis` (`id`);

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `contrat_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `produitsvendeur`
--
ALTER TABLE `produitsvendeur`
  ADD CONSTRAINT `produitsvendeur_ibfk_1` FOREIGN KEY (`idPanier`) REFERENCES `panier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
