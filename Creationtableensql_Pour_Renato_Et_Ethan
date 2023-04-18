

DROP DATABASE IF EXISTS lenil;  -- creer la base avant
CREATE DATABASE lenil;
USE lenil;  -- se connecter a la base

-- HEAD

CREATE TABLE Compte(  -- Vendeur ou Client 
    email varchar(100) NOT NULL PRIMARY KEY, 
    motDePasse varchar(50) NOT NULL,
    abonnement SMALLINT NOT NULL, -- 0: pas abonné / 1 abonné mensuel / 2 abonné annuel
    dateAbonnement DATE DEFAULT NULL,
    signatureContratClient BOOLEAN NOT NULL, -- TRUE = Compte Client
    signatureContratVendeur BOOLEAN NOT NULL, -- TRUE = Compte Vendeur peut etre les deux
    signatureContratLivreur BOOLEAN NOT NULL -- TRUE = Compte Livreur peut etre les deux

);

CREATE TABLE Contrat( 
    numero SMALLINT NOT NULL Primary Key, -- 1 contrat CLient / 2 vendeur / 3 Livreur 
    texte TEXT NOT NULL
);

CREATE TABLE InfoCompte (
    emailCompte varchar(100) NOT NULL PRIMARY KEY, 
    prenom varchar(50) NOT NULL,
    nom varchar(50) NOT NULL,
    dateNaissance date NOT NULL,
    telephone varchar(10) NOT NULL,
    adresse varchar(250) NOT NULL,
    ville varchar(50) NOT NULL,
    codePostal INT NOT NULL,
    pays varchar(50) NOT NULL,
    FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);

CREATE TABLE ProduitsVendeur (

    id INT NOT NULL PRIMARY KEY,
    emailVendeur varchar(100) NOT NULL,
    QuantiteVendeur INT NOT NULL,
    prix decimal(10,2) NOT NULL,
    NomImage char(50) NOT NULL,
    nom char(100) NOT NULL,
    description TEXT,
    minidescription varchar(200) NOT NULL,
    FOREIGN KEY (emailVendeur) REFERENCES Compte(email)
);

CREATE TABLE Panier (
    emailCompte varchar(100) NOT NULL PRIMARY KEY,
    HT decimal(10,2) NOT NULL,
    TVA decimal(10,2) NOT NULL,
    TTC decimal(10,2) NOT NULL,

    FOREIGN KEY (emailCompte) REFERENCES Compte(email)

);


CREATE TABLE ContenuPanier (
    
    idProduitsVendeur INT NOT NULL PRIMARY KEY,
    QuantitePanier INT NOT NULL,
    emailCompte varchar(100)  NOT NULL REFERENCES Compte(email),
    FOREIGN KEY (idProduitsVendeur) REFERENCES ProduitsVendeur(id)
);


CREATE TABLE Commande (
    id INT NOT NULL PRIMARY KEY,
    totalPayer decimal(10,2) CHECK (not(totalPayer < 0)),
    modePayment varchar(20) NOT NULL,
    datePayment date NOT NULL
);

CREATE TABLE Colis (
    id INT NOT NULL PRIMARY KEY,
    longueur decimal(10,2) CHECK (longueur > 0),
    hauteur decimal(10,2) CHECK (hauteur > 0),
    poids decimal(10,2) CHECK(poids > 0),
    idCommande int NOT NULL,
    FOREIGN KEY (idCommande) REFERENCES Commande(id)
);


CREATE TABLE a_CommandeContientProduitVendeur(
    idCommande INT NOT NULL,
    idProduitVendeur INT NOT NULL,
    PRIMARY KEY(idCommande,idProduitVendeur),
    FOREIGN KEY (idCommande) REFERENCES Commande(id),
    FOREIGN KEY (idProduitVendeur) REFERENCES ProduitsVendeur(id)
);

CREATE TABLE Recherche(
    emailCompte varchar(100) NOT NULL PRIMARY KEY,
    motCle varchar(255) NOT NULL,
    FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);
/*
CREATE TABLE Caracteristique(
    id INT NOT NULL PRIMARY KEY,
    valeur varchar(10) NOT NULL,
    nom varchar(50) NOT NULL
);

CREATE TABLE Produit(
    id INT NOT NULL PRIMARY KEY,
    description varchar(255) NOT NULL,
    idCaracteristique INT NOT NULL REFERENCES Caracteristique(id) 
);
*/

CREATE TABLE MoyenPayment(
    id INT NOT NULL Primary key,
    modePayment ENUM('paypal', 'cb') NOT NULL
);

CREATE TABLE a_payePar(
    emailCompte varchar(50) NOT NULL,
    idMoyenPayment int NOT NULL,
    Primary KEY (emailCompte,idMoyenPayment),
    FOREIGN KEY (emailCompte) REFERENCES Compte(email),
    FOREIGN KEY (idMoyenPayment) REFERENCES MoyenPayment(id)
);

CREATE TABLE Adresse(
	id int PRIMARY KEY AUTO_INCREMENT,
	numeroRue varchar(255) NOT NULL,
	nomRue varchar(255) NOT NULL,
	codePostal SMALLINT NOT NULL,
	ville varchar(100) NOT NULL,
	pays varchar(50) NOT NULL,
	complementAdresse varchar(255),
	idCommande int NOT NULL,
	FOREIGN KEY (idCommande) REFERENCES Commande(id)
);


CREATE TABLE QuantiteCommande(
    id INT NOT NULL PRIMARY KEY,
    quantite DECIMAL(2) NOT NULL
);


CREATE TABLE CB(
	id INT NOT NULL PRIMARY KEY,
	numero INT NOT NULL,
	date_expiration DATE NOT NULL,
	CVV INT NOT NULL,
	idCommande int NOT NULL,
	emailCompte varchar(100) NOT NULL,
	FOREIGN KEY (idCommande) REFERENCES Commande(id),
	FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);

CREATE TABLE Paypal(
	id INT NOT NULL PRIMARY KEY,
	email char(50) NOT NULL,
	mot_de_passe char(50) NOT NULL,
	idCommande INT NOT NULL,
	emailCompte varchar(50) NOT NULL,
	FOREIGN KEY (idCommande) REFERENCES Commande(id),
	FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);

-- Table de la relation ternaire

CREATE TABLE Adresse_Commande_QuantiteCommande(
	idAdresse INT NOT NULL,
	idCommande INT NOT NULL,
	idQuantiteCommande INT NOT NULL,
	PRIMARY KEY (idAdresse,idCommande,idQuantiteCommande),
	Foreign KEY (idAdresse) REFERENCES Adresse(id),
	FOREIGN KEY (idCommande) REFERENCES Commande(id),
	FOREIGN KEY (idQuantiteCommande) REFERENCES QuantiteCommande(id)
);

INSERT INTO Compte VALUES ('ethanpINTo02@gmail.com', '123456', 0,NULL, 1, 0,0),
                            ('samy.belbouab@gmail.com', '123456', 2,'2023-03-21',1,0,0),
                            ('foulonclem@cy-tech.fr', '123456', 0,NULL,1,0,0),
                            ('abdellah.hassani2002@gmail.com', '123456', 1,'2023-03-01',1,0,0),
                            ('renato.nascimento.ardiles@cy-tech.fr', '123456', 0,NULL,1,0,1),
                            ('magasin1@gmail.com', '123456', 2,'2023-03-11', 0, 1,0),
                            ('magasin2@gmail.com', '123456', 2, '2023-02-14',0, 1,0);
                            

INSERT INTO InfoCompte VALUES ('ethanpINTo02@gmail.com','Ethan','Pinto','2000-03-21','0661839460','22 rue de la petite-nuit','Cergy',95800,'France'),
                            ('samy.belbouab@gmail.com','Samy','Belbouab','2002-02-18','0610122887','26 rue de le grande piece','Menucourt',95180,'France'),
                            ('foulonclem@cy-tech.fr','Clement','Foulon','2002-03-19','0632135190','22 boulevard de l oise','Cergy',95000,'France'),
                            ('abdellah.hassani2002@gmail.com','Abdellah','Hassani','2000-03-21','0767756606','15 bd du port','Cergy',95000,'France'),
                            ('renato.nascimento.ardiles@cy-tech.fr','Renato','Nascimento Ardiles','2000-03-21','0000000000','22 rue de la petite-nuit','Cergy',95000,'France'),
                            ('magasin1@gmail.com','MAGASIN1','MAGASIN1','1989-05-11','0130365987','12 Allée de la Garance','PARIS',75019,'France'),
                            ('magasin2@gmail.com','MAGASIN2','MAGASIN2','1989-05-11','0130365987','130, Clos Chapelle-aux-Champs','PARIS',75019,'France');

INSERT INTO ProduitsVendeur VALUES (1,'magasin1@gmail.com',100,29.99,'casque.png','Casque','Grâce à la nouvelle conception de son boîtier de commande audio USB et sa carte son intégrée, HyperX Cloud II amplifie l''audio et la voix pour créer une expérience de jeu Hi-Fi optimale. Vous serez toujours certain de tout entendre. Vous accédez à un monde de détails que les autres gamers ne connaîtront jamais : le bruissement d''une botte dans les feuilles, une course furtive dans une conduite. Les commandes indépendantes permettent de régler le volume de l''écoute et le niveau du micro. Vous pouvez aussi activer le son Surround 7.1 ou le micro.','Accessoire de mode'),
                            (2,'magasin1@gmail.com',150,19.99,'casquette.jpg','Casquette','Balinco Casquette d''hélice colorée | Casquette d''hélicoptère | Casquette de propulseur | Casquette de Baseball pour Adultes et Enfants - Taille Ajustable','Accessoire de mode'),
                            (3,'magasin1@gmail.com',200,9.99,'chaussette.jpg','Chaussette',NULL,'Chaussette confortable'),
                            (4,'magasin2@gmail.com',150,19.99,'casquette.jpg','Casquette',NULL,'Accessoire de mode'),
                            (5,'magasin1@gmail.com',55,29.99,'clavier.jpg','Clavier',NULL,'Clavier de jeu'),
                            (6,'magasin1@gmail.com',75,149.99,'ecran.jpg','Ecran',NULL,'Ecran haute résolution'),
                            (7,'magasin1@gmail.com',44,14.99,'hdmi.jpg','Câble Hdmi',NULL,'Câble de connexion'),                                                                               
                            (8,'magasin2@gmail.com',65,50.99,'lego2.jpg','Lego City',NULL,'Lego pour construire votre ville'),
                            (9,'magasin2@gmail.com',86,45.99,'lego_voiture.jpg','Lego Technic Voiture',NULL,'Lego pour adulte'),
                            (10,'magasin2@gmail.com',26,5.99,'lunette_soleil.jpg','Lunette soleil',NULL,'Accessoire de mode'),
                            (11,'magasin2@gmail.com',75,24.99,'manette.jpg','Manette',NULL,'Manette de jeu'),
                            (12,'magasin2@gmail.com',99,699.99,'ordi_portable.jpg','Ordinateur Portable',NULL,'Ordinateur portable pour gamer'),
                            (13,'magasin1@gmail.com',458,5.99,'playmobil.jpg','Playmobil 1.0',NULL,'Pour vos enfants'),
                            (14,'magasin1@gmail.com',54,6.99,'playmobil2.jpeg','Playmobil 2.0',NULL,'Pour vos enfants'),
                            (15,'magasin1@gmail.com',865,13.99,'souris.jpg','Souris',NULL,'Souris de jeu'),
                            (16,'magasin1@gmail.com',254,949.99,'tour.jpg','Tour PC',NULL,'Ordinateur pour gamer'),
                            (17,'magasin1@gmail.com',55,29.99,'claquette.jpg','Claquette',NULL,'Chaussure d''été');




INSERT INTO Panier VALUES ('abdellah.hassani2002@gmail.com',100,20,120);

INSERT INTO ContenuPanier VALUES (7,5,'abdellah.hassani2002@gmail.com'),
                            (17,5,'abdellah.hassani2002@gmail.com');                            

INSERT INTO Commande VALUES (457,49.99,'CB','2023-03-21');
INSERT INTO Colis VALUES (27,55,40,7.5,457),(28,5,4,3.5,457);

INSERT INTO Contrat VALUES (1,'Vous pouvez avoir besoin de un compte personnel LENIL pour utiliser certain Services LENIL, 
et il peut vous être demandé de vous connecter au compte et de avoir une méthode de paiement valide associée à celui-ci. 
En cas de problème pour utiliser la méthode de paiement que vous avez sélectionnée, nous pourrons utiliser toute autre méthode de paiement valide associée à votre compte.
Accédez à Votre compte pour gérer vos options de paiement.Si vous utilisez un quelconque Service LENIL,
 vous êtes responsable du maintien de la confidentialité de votre compte et mot de passe, des restrictions de accès à votre ordinateur et autres équipements,
et dans la limite de ce qui est autorisé par la loi applicable, vous acceptez de être responsable de toutes 
les activités qui ont été menées depuis de votre compte ou avec votre mot de passe. Vous devez prendre toutes les mesures
 nécessaires pour vous assurer que votre mot de passe reste confidentiel et sécurisé, et devez nous informer immédiatement 
 si vous avez des raisons de croire que votre mot de passe est connu de quelque un de autre, ou si le mot de passe est
  utilisé ou susceptible de etre utilisé de manière non autorisée. Vous êtes responsable de la validité et du caractère complets 
  des informations que vous nous avez fournies, et devez nous informer de tout changement concernant ces informations. 
Vous pouvez accéder à vos informations dans la section Votre compte du site internet. Veuillez consulter nos pages de aide relatives
 à la Protection de vos informations personnelles pour accéder à vos informations personnelles.'),

(2,'VENDEURS TIERS ET ROLE De LENIL permet à des vendeurs tiers de lister et de vendre leurs produits sur LENIL.fr.
 Dans chacun de ces cas, ceci est indiqué sur la page respective de détail du produit. Bien que LENIL, en tant que hébergeur,
  facilite les transactions réalisées sur la place de marché (ou Marketplace) de LENIL, LENIL n est ni l acheteur ni le 
  vendeur des produits des vendeurs tiers. LENIL fournit un lieu de rencontre dans lequel les acheteurs et vendeurs 
  complètent et finalisent leurs transactions. En conséquence, pour la vente de ces produits de vendeurs tiers, un contrat 
  de vente est formé uniquement entre l acheteur et le vendeur tiers. LENIL n  est pas partie à un tel contrat et n  assume
   aucune responsabilité ayant pour origine un tel contrat ou découlant de ce contrat de vente. LENIL n  est ni l  agent 
   ni le mandataire des vendeurs tiers. Sauf dans les cas mentionnés ci-dessous dans cette section, le vendeur tiers est 
   responsable des ventes de produits et des réclamations ou tout autre problème survenant ou lié au contrat de vente entre 
   lui et l  acheteur. Parce qu  LENIL souhaite que l  acheteur bénéficie d  une expérience d  achat la plus sûre, LENIL
    offre la Garantie A à Z en plus de tout droit contractuel ou autre.
Veuillez noter que certains vendeurs tiers peuvent vendre en tant que particuliers et non en tant 
que vendeurs professionnels. Dans chaque cas, ces informations sont indiquées sur la page d’informations détaillées 
concernant le vendeur (à laquelle vous pouvez accéder en cliquant sur le nom de ce dernier) et sont basées sur les 
informations fournies par le vendeur à LENIL. Si un vendeur n’est pas un professionnel, veuillez noter que vos droits légaux habituels 
en vertu des lois sur la protection des consommateurs (par exemple, des droits de garantie de 2 ou 3 ans, selon le pays, et le droit
 d’annuler votre commande dans les 14 jours sans devoir exposer de raison) ne s’appliqueront pas. Toutefois, la garantie A à Z d’LENIL 
 et notre garantie de retour volontaire de 30 jours s’appliqueront toujours dans ce cas.'),

(3,'Vous pouvez avoir besoin d  un compte personnel LENIL pour utiliser certain Services LENIL, 
et il peut vous être demandé de vous connecter au compte et d  avoir une méthode de paiement valide associée à celui-ci.
 En cas de problème pour utiliser la méthode de paiement que vous avez sélectionnée, nous pourrons utiliser toute autre méthode 
 de paiement valide associée à votre compte. Accédez à Votre compte pour gérer vos options de paiement.
Si vous utilisez un quelconque Service LENIL, vous êtes responsable du maintien de la confidentialité de votre compte et mot de passe, 
des restrictions d  accès à votre ordinateur et autres équipements, et dans la limite de ce qui est autorisé par la loi applicable, 
vous acceptez d  être responsable de toutes les activités qui ont été menées depuis de votre compte ou avec votre mot de passe. 
Vous devez prendre toutes les mesures nécessaires pour vous assurer que votre mot de passe reste confidentiel et sécurisé, 
et devez nous informer immédiatement si vous avez des raisons de croire que votre mot de passe est connu de quelqu  un d  a
utre, ou si le mot de passe est utilisé ou susceptible d  être utilisé de manière non autorisée. Vous êtes responsable de la 
validité et du caractère complets des informations que vous nous avez fournies, et devez nous informer de tout changement concernant 
ces informations. Vous pouvez accéder à vos informations dans la section Votre compte du site internet. Veuillez consulter nos pages 
d  aide relatives à la Protection de vos informations personnelles pour accéder à vos informations personnelles.');

