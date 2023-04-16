-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 16 avr. 2023 à 17:15
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
-- Structure de la table `Adresse`
--

CREATE TABLE `Adresse` (
  `id` int NOT NULL,
  `numeroRue` varchar(255) NOT NULL,
  `nomRue` varchar(255) NOT NULL,
  `codePostal` smallint NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `complementAdresse` varchar(255) DEFAULT NULL,
  `idCommande` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Adresse_Commande_QuantiteCommande`
--

CREATE TABLE `Adresse_Commande_QuantiteCommande` (
  `idAdresse` int NOT NULL,
  `idCommande` int NOT NULL,
  `idQuantiteCommande` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a_CommandeContientProduitVendeur`
--

CREATE TABLE `a_CommandeContientProduitVendeur` (
  `idCommande` int NOT NULL,
  `idProduitVendeur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a_payePar`
--

CREATE TABLE `a_payePar` (
  `emailCompte` varchar(50) NOT NULL,
  `idMoyenPayment` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Caracteristique`
--

CREATE TABLE `Caracteristique` (
  `id` int NOT NULL,
  `valeur` varchar(10) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CB`
--

CREATE TABLE `CB` (
  `id` int NOT NULL,
  `numero` int NOT NULL,
  `date_expiration` date NOT NULL,
  `CVV` int NOT NULL,
  `idCommande` int NOT NULL,
  `emailCompte` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Colis`
--

CREATE TABLE `Colis` (
  `id` int NOT NULL,
  `longueur` smallint DEFAULT NULL,
  `hauteur` smallint DEFAULT NULL,
  `poids` smallint DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `id` int NOT NULL,
  `totalPayer` int DEFAULT NULL,
  `modePayment` varchar(20) NOT NULL,
  `datePayment` date NOT NULL,
  `idColis` int NOT NULL
) ;

-- --------------------------------------------------------

--
-- Structure de la table `Compte`
--

CREATE TABLE `Compte` (
  `email` varchar(100) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `abonnement` smallint NOT NULL,
  `signatureContratClient` tinyint(1) NOT NULL,
  `signatureContratVendeur` tinyint(1) NOT NULL,
  `signatureContratLivreur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ContenuPanier`
--

CREATE TABLE `ContenuPanier` (
  `idProduitsVendeur` int NOT NULL,
  `QuantitePanier` int NOT NULL,
  `idPanier` int NOT NULL,
  `idProduitVendeur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Contrat`
--

CREATE TABLE `Contrat` (
  `numero` int NOT NULL,
  `texte` varchar(255) NOT NULL,
  `emailCompte` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `InfoCompte`
--

CREATE TABLE `InfoCompte` (
  `emailCompte` varchar(100) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `telephone` int NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `codePostal` int NOT NULL,
  `pays` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MoyenPayment`
--

CREATE TABLE `MoyenPayment` (
  `id` int NOT NULL,
  `modePayment` enum('paypal','cb') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Panier`
--

CREATE TABLE `Panier` (
  `emailCompte` varchar(100) NOT NULL,
  `HT` decimal(10,0) NOT NULL,
  `TVA` decimal(10,0) NOT NULL,
  `TTC` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Paypal`
--

CREATE TABLE `Paypal` (
  `id` int NOT NULL,
  `email` char(50) NOT NULL,
  `mot_de_passe` char(50) NOT NULL,
  `idCommande` int NOT NULL,
  `emailCompte` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `id` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `idCaracteristique` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ProduitsVendeur`
--

CREATE TABLE `ProduitsVendeur` (
  `id` int NOT NULL,
  `emailVendeur` varchar(100) NOT NULL,
  `QuantiteVendeur` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `NomImage` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `QuantiteCommande`
--

CREATE TABLE `QuantiteCommande` (
  `id` int NOT NULL,
  `quantite` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Recherche`
--

CREATE TABLE `Recherche` (
  `motCle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Adresse`
--
ALTER TABLE `Adresse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `Adresse_Commande_QuantiteCommande`
--
ALTER TABLE `Adresse_Commande_QuantiteCommande`
  ADD PRIMARY KEY (`idAdresse`,`idCommande`,`idQuantiteCommande`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idQuantiteCommande` (`idQuantiteCommande`);

--
-- Index pour la table `a_CommandeContientProduitVendeur`
--
ALTER TABLE `a_CommandeContientProduitVendeur`
  ADD PRIMARY KEY (`idCommande`,`idProduitVendeur`),
  ADD KEY `idProduitVendeur` (`idProduitVendeur`);

--
-- Index pour la table `a_payePar`
--
ALTER TABLE `a_payePar`
  ADD PRIMARY KEY (`emailCompte`,`idMoyenPayment`),
  ADD KEY `idMoyenPayment` (`idMoyenPayment`);

--
-- Index pour la table `Caracteristique`
--
ALTER TABLE `Caracteristique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `CB`
--
ALTER TABLE `CB`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `emailCompte` (`emailCompte`);

--
-- Index pour la table `Colis`
--
ALTER TABLE `Colis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idColis` (`idColis`);

--
-- Index pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `ContenuPanier`
--
ALTER TABLE `ContenuPanier`
  ADD PRIMARY KEY (`idProduitsVendeur`);

--
-- Index pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `emailCompte` (`emailCompte`);

--
-- Index pour la table `InfoCompte`
--
ALTER TABLE `InfoCompte`
  ADD PRIMARY KEY (`emailCompte`);

--
-- Index pour la table `MoyenPayment`
--
ALTER TABLE `MoyenPayment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD PRIMARY KEY (`emailCompte`);

--
-- Index pour la table `Paypal`
--
ALTER TABLE `Paypal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `emailCompte` (`emailCompte`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ProduitsVendeur`
--
ALTER TABLE `ProduitsVendeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emailVendeur` (`emailVendeur`);

--
-- Index pour la table `QuantiteCommande`
--
ALTER TABLE `QuantiteCommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Recherche`
--
ALTER TABLE `Recherche`
  ADD PRIMARY KEY (`motCle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Adresse`
--
ALTER TABLE `Adresse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Adresse`
--
ALTER TABLE `Adresse`
  ADD CONSTRAINT `Adresse_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `Commande` (`id`);

--
-- Contraintes pour la table `Adresse_Commande_QuantiteCommande`
--
ALTER TABLE `Adresse_Commande_QuantiteCommande`
  ADD CONSTRAINT `Adresse_Commande_QuantiteCommande_ibfk_1` FOREIGN KEY (`idAdresse`) REFERENCES `Adresse` (`id`),
  ADD CONSTRAINT `Adresse_Commande_QuantiteCommande_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `Commande` (`id`),
  ADD CONSTRAINT `Adresse_Commande_QuantiteCommande_ibfk_3` FOREIGN KEY (`idQuantiteCommande`) REFERENCES `QuantiteCommande` (`id`);

--
-- Contraintes pour la table `a_CommandeContientProduitVendeur`
--
ALTER TABLE `a_CommandeContientProduitVendeur`
  ADD CONSTRAINT `a_CommandeContientProduitVendeur_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `Commande` (`id`),
  ADD CONSTRAINT `a_CommandeContientProduitVendeur_ibfk_2` FOREIGN KEY (`idProduitVendeur`) REFERENCES `ProduitsVendeur` (`id`);

--
-- Contraintes pour la table `a_payePar`
--
ALTER TABLE `a_payePar`
  ADD CONSTRAINT `a_payePar_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `Compte` (`email`),
  ADD CONSTRAINT `a_payePar_ibfk_2` FOREIGN KEY (`idMoyenPayment`) REFERENCES `MoyenPayment` (`id`);

--
-- Contraintes pour la table `CB`
--
ALTER TABLE `CB`
  ADD CONSTRAINT `CB_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `Commande` (`id`),
  ADD CONSTRAINT `CB_ibfk_2` FOREIGN KEY (`emailCompte`) REFERENCES `Compte` (`email`);

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `Commande_ibfk_1` FOREIGN KEY (`idColis`) REFERENCES `Colis` (`id`);

--
-- Contraintes pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD CONSTRAINT `Contrat_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `Compte` (`email`);

--
-- Contraintes pour la table `InfoCompte`
--
ALTER TABLE `InfoCompte`
  ADD CONSTRAINT `InfoCompte_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `Compte` (`email`);

--
-- Contraintes pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD CONSTRAINT `Panier_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `Compte` (`email`);

--
-- Contraintes pour la table `Paypal`
--
ALTER TABLE `Paypal`
  ADD CONSTRAINT `Paypal_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `Commande` (`id`),
  ADD CONSTRAINT `Paypal_ibfk_2` FOREIGN KEY (`emailCompte`) REFERENCES `Compte` (`email`);

--
-- Contraintes pour la table `ProduitsVendeur`
--
ALTER TABLE `ProduitsVendeur`
  ADD CONSTRAINT `ProduitsVendeur_ibfk_1` FOREIGN KEY (`emailVendeur`) REFERENCES `Compte` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
