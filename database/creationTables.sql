-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 20 avr. 2023 à 18:14
-- Version du serveur : 8.0.28
-- Version de PHP : 8.0.28

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
  `nomRue` varchar(255) NOT NULL,
  `codePostal` smallint NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(50) NOT NULL,
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
-- Structure de la table `cb`
--

CREATE TABLE `cb` (
  `id` int NOT NULL,
  `numero` int NOT NULL,
  `date_expiration` date NOT NULL,
  `CVV` int NOT NULL,
  `idCommande` int NOT NULL,
  `emailCompte` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `code_promo`
--

CREATE TABLE `code_promo` (
  `id` int NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Valeur_Code` int NOT NULL,
  `APartirDeCombien` int NOT NULL,
  `dateDePeremption` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `code_promo`
--

INSERT INTO `code_promo` (`id`, `Code`, `Valeur_Code`, `APartirDeCombien`, `dateDePeremption`) VALUES
(1, 'PRIMTEMPS', 20, 80, '2023-06-21'),
(2, 'PROMO10', 10, 100, '2023-04-30'),
(3, 'AVRIL2023', 15, 60, '2023-04-30');

-- --------------------------------------------------------

--
-- Structure de la table `colis`
--

CREATE TABLE `colis` (
  `id` int NOT NULL,
  `longueur` decimal(10,2) DEFAULT NULL,
  `hauteur` decimal(10,2) DEFAULT NULL,
  `poids` decimal(10,2) DEFAULT NULL,
  `idCommande` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `colis`
--

INSERT INTO `colis` (`id`, `longueur`, `hauteur`, `poids`, `idCommande`) VALUES
(27, 55.00, 40.00, 7.50, 457),
(28, 5.00, 4.00, 3.50, 457);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int NOT NULL,
  `totalPayer` decimal(10,2) DEFAULT NULL,
  `modePayment` varchar(20) NOT NULL,
  `datePayment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `totalPayer`, `modePayment`, `datePayment`) VALUES
(457, 49.99, 'CB', '2023-03-21');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `email` varchar(100) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `abonnement` smallint NOT NULL,
  `dateAbonnement` date DEFAULT NULL,
  `signatureContratClient` tinyint(1) NOT NULL,
  `signatureContratVendeur` tinyint(1) NOT NULL,
  `signatureContratLivreur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`email`, `motDePasse`, `abonnement`, `dateAbonnement`, `signatureContratClient`, `signatureContratVendeur`, `signatureContratLivreur`) VALUES
('abdellah.hassani2002@gmail.com', '123456', 1, '2023-03-01', 1, 0, 0),
('ethanpINTo02@gmail.com', '123456', 0, NULL, 1, 0, 0),
('foulonclem@cy-tech.fr', '123456', 0, NULL, 1, 0, 0),
('magasin1@gmail.com', '123456', 2, '2023-03-11', 0, 1, 0),
('magasin2@gmail.com', '123456', 2, '2023-02-14', 0, 1, 0),
('renato.nascimento.ardiles@cy-tech.fr', '123456', 0, NULL, 1, 0, 1),
('samy.belbouab@gmail.com', '123456', 2, '2023-03-21', 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `contenupanier`
--

CREATE TABLE `contenupanier` (
  `idProduitsVendeur` int NOT NULL,
  `QuantitePanier` int NOT NULL,
  `emailCompte` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contenupanier`
--

INSERT INTO `contenupanier` (`idProduitsVendeur`, `QuantitePanier`, `emailCompte`) VALUES
(7, 5, 'abdellah.hassani2002@gmail.com'),
(17, 5, 'abdellah.hassani2002@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `numero` smallint NOT NULL,
  `texte` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`numero`, `texte`) VALUES
(1, 'Vous pouvez avoir besoin de un compte personnel LENIL pour utiliser certain Services LENIL, \net il peut vous être demandé de vous connecter au compte et de avoir une méthode de paiement valide associée à celui-ci. \nEn cas de problème pour utiliser la méthode de paiement que vous avez sélectionnée, nous pourrons utiliser toute autre méthode de paiement valide associée à votre compte.\nAccédez à Votre compte pour gérer vos options de paiement.Si vous utilisez un quelconque Service LENIL,\n vous êtes responsable du maintien de la confidentialité de votre compte et mot de passe, des restrictions de accès à votre ordinateur et autres équipements,\net dans la limite de ce qui est autorisé par la loi applicable, vous acceptez de être responsable de toutes \nles activités qui ont été menées depuis de votre compte ou avec votre mot de passe. Vous devez prendre toutes les mesures\n nécessaires pour vous assurer que votre mot de passe reste confidentiel et sécurisé, et devez nous informer immédiatement \n si vous avez des raisons de croire que votre mot de passe est connu de quelque un de autre, ou si le mot de passe est\n  utilisé ou susceptible de etre utilisé de manière non autorisée. Vous êtes responsable de la validité et du caractère complets \n  des informations que vous nous avez fournies, et devez nous informer de tout changement concernant ces informations. \nVous pouvez accéder à vos informations dans la section Votre compte du site internet. Veuillez consulter nos pages de aide relatives\n à la Protection de vos informations personnelles pour accéder à vos informations personnelles.'),
(2, 'VENDEURS TIERS ET ROLE De LENIL permet à des vendeurs tiers de lister et de vendre leurs produits sur LENIL.fr.\n Dans chacun de ces cas, ceci est indiqué sur la page respective de détail du produit. Bien que LENIL, en tant que hébergeur,\n  facilite les transactions réalisées sur la place de marché (ou Marketplace) de LENIL, LENIL n est ni l acheteur ni le \n  vendeur des produits des vendeurs tiers. LENIL fournit un lieu de rencontre dans lequel les acheteurs et vendeurs \n  complètent et finalisent leurs transactions. En conséquence, pour la vente de ces produits de vendeurs tiers, un contrat \n  de vente est formé uniquement entre l acheteur et le vendeur tiers. LENIL n  est pas partie à un tel contrat et n  assume\n   aucune responsabilité ayant pour origine un tel contrat ou découlant de ce contrat de vente. LENIL n  est ni l  agent \n   ni le mandataire des vendeurs tiers. Sauf dans les cas mentionnés ci-dessous dans cette section, le vendeur tiers est \n   responsable des ventes de produits et des réclamations ou tout autre problème survenant ou lié au contrat de vente entre \n   lui et l  acheteur. Parce qu  LENIL souhaite que l  acheteur bénéficie d  une expérience d  achat la plus sûre, LENIL\n    offre la Garantie A à Z en plus de tout droit contractuel ou autre.\nVeuillez noter que certains vendeurs tiers peuvent vendre en tant que particuliers et non en tant \nque vendeurs professionnels. Dans chaque cas, ces informations sont indiquées sur la page d’informations détaillées \nconcernant le vendeur (à laquelle vous pouvez accéder en cliquant sur le nom de ce dernier) et sont basées sur les \ninformations fournies par le vendeur à LENIL. Si un vendeur n’est pas un professionnel, veuillez noter que vos droits légaux habituels \nen vertu des lois sur la protection des consommateurs (par exemple, des droits de garantie de 2 ou 3 ans, selon le pays, et le droit\n d’annuler votre commande dans les 14 jours sans devoir exposer de raison) ne s’appliqueront pas. Toutefois, la garantie A à Z d’LENIL \n et notre garantie de retour volontaire de 30 jours s’appliqueront toujours dans ce cas.'),
(3, 'Vous pouvez avoir besoin d  un compte personnel LENIL pour utiliser certain Services LENIL, \net il peut vous être demandé de vous connecter au compte et d  avoir une méthode de paiement valide associée à celui-ci.\n En cas de problème pour utiliser la méthode de paiement que vous avez sélectionnée, nous pourrons utiliser toute autre méthode \n de paiement valide associée à votre compte. Accédez à Votre compte pour gérer vos options de paiement.\nSi vous utilisez un quelconque Service LENIL, vous êtes responsable du maintien de la confidentialité de votre compte et mot de passe, \ndes restrictions d  accès à votre ordinateur et autres équipements, et dans la limite de ce qui est autorisé par la loi applicable, \nvous acceptez d  être responsable de toutes les activités qui ont été menées depuis de votre compte ou avec votre mot de passe. \nVous devez prendre toutes les mesures nécessaires pour vous assurer que votre mot de passe reste confidentiel et sécurisé, \net devez nous informer immédiatement si vous avez des raisons de croire que votre mot de passe est connu de quelqu  un d  a\nutre, ou si le mot de passe est utilisé ou susceptible d  être utilisé de manière non autorisée. Vous êtes responsable de la \nvalidité et du caractère complets des informations que vous nous avez fournies, et devez nous informer de tout changement concernant \nces informations. Vous pouvez accéder à vos informations dans la section Votre compte du site internet. Veuillez consulter nos pages \nd  aide relatives à la Protection de vos informations personnelles pour accéder à vos informations personnelles.');

-- --------------------------------------------------------

--
-- Structure de la table `infocompte`
--

CREATE TABLE `infocompte` (
  `emailCompte` varchar(100) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `codePostal` int NOT NULL,
  `pays` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `infocompte`
--

INSERT INTO `infocompte` (`emailCompte`, `prenom`, `nom`, `dateNaissance`, `telephone`, `adresse`, `ville`, `codePostal`, `pays`) VALUES
('abdellah.hassani2002@gmail.com', 'Abdellah', 'Hassani', '2000-03-21', '0767756606', '15 bd du port', 'Cergy', 95000, 'France'),
('ethanpINTo02@gmail.com', 'Ethan', 'Pinto', '2000-03-21', '0661839460', '22 rue de la petite-nuit', 'Cergy', 95800, 'France'),
('foulonclem@cy-tech.fr', 'Clement', 'Foulon', '2002-03-19', '0632135190', '22 boulevard de l oise', 'Cergy', 95000, 'France'),
('magasin1@gmail.com', 'MAGASIN1', 'MAGASIN1', '1989-05-11', '0130365987', '12 Allée de la Garance', 'PARIS', 75019, 'France'),
('magasin2@gmail.com', 'MAGASIN2', 'MAGASIN2', '1989-05-11', '0130365987', '130, Clos Chapelle-aux-Champs', 'PARIS', 75019, 'France'),
('renato.nascimento.ardiles@cy-tech.fr', 'Renato', 'Nascimento Ardiles', '2000-03-21', '0000000000', '22 rue de la petite-nuit', 'Cergy', 95000, 'France'),
('samy.belbouab@gmail.com', 'Samy', 'Belbouab', '2002-02-18', '0610122887', '26 rue de le grande piece', 'Menucourt', 95180, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `moyenpayment`
--

CREATE TABLE `moyenpayment` (
  `id` int NOT NULL,
  `modePayment` enum('paypal','cb') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `emailCompte` varchar(100) NOT NULL,
  `HT` decimal(10,2) NOT NULL,
  `TVA` decimal(10,2) NOT NULL,
  `TTC` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`emailCompte`, `HT`, `TVA`, `TTC`) VALUES
('abdellah.hassani2002@gmail.com', 100.00, 20.00, 120.00);

-- --------------------------------------------------------

--
-- Structure de la table `paypal`
--

CREATE TABLE `paypal` (
  `id` int NOT NULL,
  `email` char(50) NOT NULL,
  `mot_de_passe` char(50) NOT NULL,
  `idCommande` int NOT NULL,
  `emailCompte` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produitsvendeur`
--

CREATE TABLE `produitsvendeur` (
  `id` int NOT NULL,
  `emailVendeur` varchar(100) NOT NULL,
  `QuantiteVendeur` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `NomImage` char(50) NOT NULL,
  `nom` char(100) NOT NULL,
  `description` text,
  `minidescription` varchar(200) NOT NULL,
  `categorie` enum('Informatique','Jeux pour enfant','Vêtement','Lego') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produitsvendeur`
--

INSERT INTO `produitsvendeur` (`id`, `emailVendeur`, `QuantiteVendeur`, `prix`, `NomImage`, `nom`, `description`, `minidescription`, `categorie`) VALUES
(1, 'magasin1@gmail.com', 100, 29.99, 'casque.png', 'Casque', 'Grâce à la nouvelle conception de son boîtier de commande audio USB et sa carte son intégrée, HyperX Cloud II amplifie l''audio et la voix pour créer une expérience de jeu Hi-Fi optimale. Vous serez toujours certain de tout entendre. Vous accédez à un monde de détails que les autres gamers ne connaîtront jamais : le bruissement d''une botte dans les feuilles, une course furtive dans une conduite. Les commandes indépendantes permettent de régler le volume de l''écoute et le niveau du micro. Vous pouvez aussi activer le son Surround 7.1 ou le micro.', 'Casque bluetooth', 'Informatique'),
(2, 'magasin1@gmail.com', 150, 19.99, 'casquette.jpg', 'Casquette', 'Balinco Casquette d''hélice colorée | Casquette d''hélicoptère | Casquette de propulseur | Casquette de Baseball pour Adultes et Enfants - Taille Ajustable', 'Accessoire de mode', 'Vêtement'),
(3, 'magasin1@gmail.com', 200, 9.99, 'chaussette.jpg', 'Chaussette', 'La chaussette confortable, c''est un vrai petit bijou pour vos pieds ! Imaginez-vous glisser vos pieds dans une matière douce et moelleuse, qui épouse parfaitement la forme de vos pieds, comme une seconde peau. La sensation est incroyablement agréable, presque comme si vous marchiez sur un nuage.\r\n\r\nLa chaussette confortable est également respirante, ce qui signifie qu''elle permet à vos pieds de respirer et de rester au sec, même pendant les journées les plus chaudes. Vous ne ressentirez pas cette sensation désagréable de pieds moites et malodorants à la fin de la journée. Au contraire, vos pieds resteront frais et secs tout au long de la journée.\r\n\r\nEt que dire de son maintien ? La chaussette confortable offre un maintien parfait, sans jamais glisser ou se froisser dans votre chaussure. Vous pouvez marcher, courir ou sauter en toute confiance, sachant que vos pieds sont parfaitement protégés et maintenus.', 'Chaussette confortable', 'Vêtement'),
(4, 'magasin2@gmail.com', 150, 14.99, 'casquette.jpg', 'Casquette', 'Le casque Bluetooth est un accessoire indispensable pour les mélomanes et les passionnés de musique ! Imaginez-vous écouter votre musique préférée sans avoir à vous soucier des fils qui s''emmêlent ou qui vous gênent. Grâce à la technologie Bluetooth, vous pouvez connecter votre casque sans fil à votre smartphone, tablette ou autre appareil compatible et profiter d''un son de qualité supérieure en toute liberté.', 'Accessoire de mode', 'Vêtement'),
(5, 'magasin1@gmail.com', 55, 29.99, 'clavier.jpg', 'Clavier', 'Le clavier sans fil est un accessoire de haute technologie qui offre une liberté totale de mouvement à l''utilisateur. Imaginez-vous travailler sur votre ordinateur depuis le canapé ou le lit, sans être gêné par des fils ou des câbles encombrants. Grâce à la technologie sans fil, vous pouvez travailler à distance, tout en profitant d''un confort de frappe optimal.\r\n\r\nLe clavier sans fil offre également une grande ergonomie, avec une disposition de touches optimisée pour réduire la fatigue et les douleurs liées à une utilisation prolongée. Il est conçu pour réduire la pression sur les mains et les poignets, ce qui vous permet de travailler plus longtemps sans ressentir de gêne.', 'Clavier de jeu', 'Informatique'),
(6, 'magasin1@gmail.com', 75, 149.99, 'ecran.jpg', 'Ecran', 'L''écran haute résolution est un accessoire indispensable pour tous ceux qui cherchent à améliorer leur expérience visuelle. Imaginez-vous regarder vos films, vos vidéos ou jouer à vos jeux vidéo préférés avec une qualité d''image exceptionnelle, offrant des détails plus précis et une meilleure définition. Grâce à l''écran haute résolution, vous pouvez profiter d''une image nette, claire et immersive.\r\n\r\nL''écran haute résolution offre également un grand confort visuel, avec une technologie d''affichage avancée qui réduit la fatigue oculaire et la tension. Les couleurs sont plus précises et les contrastes plus nets, ce qui vous permet de profiter pleinement de vos contenus préférés sans subir de fatigue oculaire.\r\n\r\n', 'Ecran haute résolution', 'Informatique'),
(7, 'magasin1@gmail.com', 44, 14.99, 'hdmi.jpg', 'Câble Hdmi', 'Le câble HDMI est un accessoire essentiel pour tout amateur de divertissement à domicile ou professionnel qui recherche une qualité d''image exceptionnelle. Imaginez-vous regarder vos films, vos séries télévisées ou jouer à vos jeux vidéo préférés avec une qualité d''image incroyablement nette et une résolution élevée. Grâce au câble HDMI, vous pouvez profiter de tous vos contenus préférés avec une qualité d''image supérieure.\r\n\r\nLe câble HDMI offre également une grande flexibilité et une grande commodité. Il permet de connecter facilement et rapidement tous vos appareils compatibles, comme votre ordinateur, votre lecteur Blu-ray, votre console de jeux ou votre téléviseur, pour une expérience de divertissement exceptionnelle. Vous pouvez facilement connecter votre câble HDMI à votre appareil et obtenir une qualité d''image haute définition sans aucun délai.', 'Câble de connexion', 'Informatique'),
(8, 'magasin2@gmail.com', 65, 50.99, 'lego2.jpg', 'Lego City', 'Lego City est une collection de jouets passionnante qui offre aux enfants et aux adultes la possibilité de créer et de vivre des aventures incroyables dans leur propre ville miniature. Imaginez-vous construire des maisons, des commerces, des véhicules et des infrastructures urbaines pour votre propre ville, en utilisant des briques de construction colorées et des figurines emblématiques Lego.', 'Lego pour construire votre ville', 'Lego'),
(9, 'magasin2@gmail.com', 86, 45.99, 'lego_voiture.jpg', 'Lego Technic Voiture', 'Lego Technic Voiture est une collection de jouets de construction passionnante qui permet aux enfants et aux adultes de créer leur propre voiture de course à partir de briques de construction Lego. Avec des pièces mobiles et des mécanismes de direction, cette collection offre une expérience de construction plus complexe et réaliste que les autres ensembles Lego.\r\n\r\nLego Technic Voiture est une expérience de construction qui offre une grande variété de défis et de récompenses. Les enfants et les adultes peuvent construire leur propre voiture de course en utilisant des techniques de construction avancées et des mécanismes de fonctionnement, tout en apprenant des concepts de génie mécanique tels que la transmission, la suspension et la direction.', 'Lego pour adulte', 'Lego'),
(10, 'magasin2@gmail.com', 26, 5.99, 'lunette_soleil.jpg', 'Lunette soleil', 'temps à l''extérieur tout en protégeant leurs yeux des rayons nocifs du soleil. Les lunettes de soleil offrent non seulement une protection contre les rayons UV, mais elles peuvent aussi être un accessoire de mode élégant qui complète votre look.\r\n\r\nLes lunettes de soleil sont conçues pour offrir une protection optimale contre les rayons UV nocifs émis par le soleil. Elles peuvent aider à prévenir les dommages causés par l''exposition prolongée au soleil, tels que la cataracte et la dégénérescence maculaire. De plus, elles peuvent également réduire l''éblouissement et améliorer la visibilité en cas de conditions de luminosité difficiles.\r\n\r\n', 'Accessoire de mode', 'Vêtement'),
(11, 'magasin2@gmail.com', 75, 24.99, 'manette.jpg', 'Manette', 'Une manette de jeux est l''outil indispensable pour tous les gamers passionnés qui cherchent à améliorer leur expérience de jeu. Les manettes de jeux offrent une grande variété de fonctionnalités et de fonctionnalités personnalisables pour répondre aux besoins et aux préférences de chaque joueur.\r\n\r\nLes manettes de jeux modernes offrent une précision et une réactivité améliorées pour des expériences de jeu plus immersives. Les boutons de commande sont disposés de manière ergonomique pour un accès facile et rapide, tandis que les sticks analogiques offrent une précision accrue pour les jeux qui nécessitent une grande précision, tels que les jeux de tir ou de course.', 'Manette de jeu', 'Informatique'),
(12, 'magasin2@gmail.com', 99, 699.99, 'ordi_portable.jpg', 'Ordinateur Portable', NULL, 'Ordinateur portable pour gamer', 'Informatique'),
(13, 'magasin1@gmail.com', 458, 5.99, 'playmobil.jpg', 'Playmobil 1.0', NULL, 'Pour vos enfants', 'Jeux pour enfant'),
(14, 'magasin1@gmail.com', 54, 6.99, 'playmobil2.jpeg', 'Playmobil 2.0', NULL, 'Pour vos enfants', 'Jeux pour enfant'),
(15, 'magasin1@gmail.com', 865, 13.99, 'souris.jpg', 'Souris', NULL, 'Souris de jeu', 'Informatique'),
(16, 'magasin1@gmail.com', 254, 949.99, 'tour.jpg', 'Tour PC', NULL, 'Ordinateur pour gamer', 'Informatique'),
(17, 'magasin1@gmail.com', 55, 29.99, 'claquette.jpg', 'Claquette', NULL, 'Chaussure d''été', 'Vêtement'),
(18, 'magasin1@gmail.com', 7, 100.00, 'LegoSonic.png', 'LEGO® Sonic the Hedgehog', NULL, 'Sonic Green Hill Zone Loop Challenge 76994', 'Lego');

-- --------------------------------------------------------

--
-- Structure de la table `quantitecommande`
--

CREATE TABLE `quantitecommande` (
  `id` int NOT NULL,
  `quantite` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recherche`
--

CREATE TABLE `recherche` (
  `emailCompte` varchar(100) NOT NULL,
  `motCle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recherche`
--

INSERT INTO `recherche` (`emailCompte`, `motCle`) VALUES
('abdellah.hassani2002@gmail.com', 'lego'),
('abdellah.hassani2002@gmail.com', 'salut');

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
-- Index pour la table `cb`
--
ALTER TABLE `cb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `emailCompte` (`emailCompte`);

--
-- Index pour la table `code_promo`
--
ALTER TABLE `code_promo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `colis`
--
ALTER TABLE `colis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `contenupanier`
--
ALTER TABLE `contenupanier`
  ADD PRIMARY KEY (`idProduitsVendeur`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `infocompte`
--
ALTER TABLE `infocompte`
  ADD PRIMARY KEY (`emailCompte`);

--
-- Index pour la table `moyenpayment`
--
ALTER TABLE `moyenpayment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`emailCompte`);

--
-- Index pour la table `paypal`
--
ALTER TABLE `paypal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `emailCompte` (`emailCompte`);

--
-- Index pour la table `produitsvendeur`
--
ALTER TABLE `produitsvendeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emailVendeur` (`emailVendeur`);

--
-- Index pour la table `quantitecommande`
--
ALTER TABLE `quantitecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recherche`
--
ALTER TABLE `recherche`
  ADD PRIMARY KEY (`emailCompte`,`motCle`);

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
  ADD CONSTRAINT `Adresse_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `adresse_commande_quantitecommande`
--
ALTER TABLE `adresse_commande_quantitecommande`
  ADD CONSTRAINT `Adresse_Commande_QuantiteCommande_ibfk_1` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`id`),
  ADD CONSTRAINT `Adresse_Commande_QuantiteCommande_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `Adresse_Commande_QuantiteCommande_ibfk_3` FOREIGN KEY (`idQuantiteCommande`) REFERENCES `quantitecommande` (`id`);

--
-- Contraintes pour la table `a_commandecontientproduitvendeur`
--
ALTER TABLE `a_commandecontientproduitvendeur`
  ADD CONSTRAINT `a_CommandeContientProduitVendeur_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `a_CommandeContientProduitVendeur_ibfk_2` FOREIGN KEY (`idProduitVendeur`) REFERENCES `produitsvendeur` (`id`);

--
-- Contraintes pour la table `a_payepar`
--
ALTER TABLE `a_payepar`
  ADD CONSTRAINT `a_payePar_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`),
  ADD CONSTRAINT `a_payePar_ibfk_2` FOREIGN KEY (`idMoyenPayment`) REFERENCES `moyenpayment` (`id`);

--
-- Contraintes pour la table `cb`
--
ALTER TABLE `cb`
  ADD CONSTRAINT `CB_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `CB_ibfk_2` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`);

--
-- Contraintes pour la table `colis`
--
ALTER TABLE `colis`
  ADD CONSTRAINT `Colis_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `contenupanier`
--
ALTER TABLE `contenupanier`
  ADD CONSTRAINT `ContenuPanier_ibfk_1` FOREIGN KEY (`idProduitsVendeur`) REFERENCES `produitsvendeur` (`id`);

--
-- Contraintes pour la table `infocompte`
--
ALTER TABLE `infocompte`
  ADD CONSTRAINT `InfoCompte_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `Panier_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`);

--
-- Contraintes pour la table `paypal`
--
ALTER TABLE `paypal`
  ADD CONSTRAINT `Paypal_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `Paypal_ibfk_2` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`);

--
-- Contraintes pour la table `produitsvendeur`
--
ALTER TABLE `produitsvendeur`
  ADD CONSTRAINT `ProduitsVendeur_ibfk_1` FOREIGN KEY (`emailVendeur`) REFERENCES `compte` (`email`);

--
-- Contraintes pour la table `recherche`
--
ALTER TABLE `recherche`
  ADD CONSTRAINT `Recherche_ibfk_1` FOREIGN KEY (`emailCompte`) REFERENCES `compte` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
