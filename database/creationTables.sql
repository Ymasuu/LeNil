DROP DATABASE IF EXISTS Marketplace;  -- creer la base avant
CREATE DATABASE Marketplace;
USE Marketplace;  -- se connecter a la base

DROP TABLE IF EXISTS Client;  -- rajouter IF EXISTSNOTBIT
DROP TABLE IF EXISTS Panier;
DROP TABLE IF EXISTS Colis;
DROP TABLE IF EXISTS Commande;
DROP TABLE IF EXISTS ProduitsVendeur;
DROP TABLE IF EXISTS Recherche;

-- HEAD

CREATE TABLE Colis (
    id INT NOT NULL PRIMARY KEY,
    longueur SMALLINT CHECK (longueur > 0),
    hauteur SMALLINT CHECK (hauteur > 0),
    poids SMALLINT CHECK(poids > 0)
);

CREATE TABLE Commande (
    id INT NOT NULL PRIMARY KEY,
    totalPayer INT CHECK (not(totalPayer < 0)),
    modePayment varchar(20) NOT NULL,
    datePayment date NOT NULL,
    idColis INT NOT NULL,
    FOREIGN KEY (idColis) REFERENCES Colis(id)
);


CREATE TABLE Compte(  -- Vendeur ou Client 
    email varchar(100) NOT NULL PRIMARY KEY, 
    motDePasse varchar(50) NOT NULL,
    abonnement INT NOT NULL, -- 0: pas abonné / 1 abonné mensuel / 2 abonné annuel
    signatureContratClient BOOLEAN NOT NULL, -- TRUE = Compte Client
    signatureContratVendeur BOOLEAN NOT NULL -- TRUE = Compte Vendeur peut etre les deux
);

CREATE TABLE InfoCompte (
    emailCompte varchar(100) NOT NULL PRIMARY KEY, 
    prenom varchar(50) NOT NULL,
    nom varchar(50) NOT NULL,
    dateNaissance date NOT NULL,
    telephone INT NOT NULL,
    adresse varchar(250) NOT NULL,
    ville varchar(50) NOT NULL,
    codePostal INT NOT NULL,
    pays varchar(50) NOT NULL,
    FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);

CREATE TABLE ProduitsVendeur (
    emailVendeur varchar(100) NOT NULL PRIMARY KEY,
    QuantiteVendeur INT NOT NULL,
    prix decimal(10,2) NOT NULL,
    NomImage char(50) NOT NULL,
    FOREIGN KEY (emailVendeur) REFERENCES Compte(email)
);

CREATE TABLE Panier (
    id INT NOT NULL PRIMARY KEY,
    HT decimal NOT NULL,
    TVA decimal NOT NULL,
    TTC decimal NOT NULL,
    emailCompte char(50) NOT NULL,
    FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);

CREATE TABLE a_CommandeContientProduitVendeur(
    idCommande INT NOT NULL,
    idProduitVendeur varchar(100) NOT NULL,
    PRIMARY KEY(idCommande,idProduitVendeur),
    FOREIGN KEY (idCommande) REFERENCES Commande(id),
    FOREIGN KEY (idProduitVendeur) REFERENCES ProduitsVendeur(emailVendeur)
);

CREATE TABLE NombrePanier (
    id INT NOT NULL PRIMARY KEY,
    QuantitePanier INT NOT NULL,
    idPanier INT  NOT NULL REFERENCES Panier(id),
    idProduitVendeur INT NOT NULL REFERENCES Panier(id) 
);

CREATE TABLE Recherche(
    motCle varchar(255) NOT NULL PRIMARY KEY
);

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

CREATE TABLE Contrat(
    numero INT NOT NULL Primary Key,
    texte varchar(255) NOT NULL,
    emailCompte varchar(100) NOT NULL,
    FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);

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
	emailCompte char(50) NOT NULL,
	FOREIGN KEY (idCommande) REFERENCES Commande(id),
	FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);

CREATE TABLE Paypal(
	id INT NOT NULL PRIMARY KEY,
	email char(50) NOT NULL,
	mot_de_passe char(50) NOT NULL,
	idCommande INT NOT NULL,
	emailCompte char(50) NOT NULL,
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

INSERT INTO Compte VALUES ('ethanpINTo02@gmail.com', '123456', 0, 1, 0);
INSERT INTO Compte VALUES ('samy.belbouab@gmail.com', '123456', 2, 1, 0);
INSERT INTO Compte VALUES ('foulonclem@cy-tech.fr', '123456', 0, 1, 0);
INSERT INTO Compte VALUES ('abdellah.hassani2002@gmail.com', '123456', 1,1,0);
INSERT INTO Compte VALUES ('renato.nascimento.ardiles@cy-tech.fr', '123456', 0, 1, 0);
INSERT INTO Compte VALUES ('magasin1@gmail.com', '123456', 2, 0, 1);

INSERT INTO InfoCompte VALUES ('ethanpINTo02@gmail.com','Ethan','Pinto','2000-03-21','0661839460','22 rue de la petite-nuit','Cergy',95800,'France');
INSERT INTO InfoCompte VALUES ('samy.belbouab@gmail.com','Samy','Belbouab','2002-02-18','0610122887','26 rue de le grande piece','Menucourt',95180,'France');
INSERT INTO InfoCompte VALUES ('foulonclem@cy-tech.fr','Clement','Foulon','2002-03-19','0632135190','22 boulevard de l oise','Cergy',95000,'France');
INSERT INTO InfoCompte VALUES ('abdellah.hassani2002@gmail.com','Abdellah','Hassani','2000-03-21','0767756606','15 bd du port','Cergy',95000,'France');
INSERT INTO InfoCompte VALUES ('renato.nascimento.ardiles@cy-tech.fr','Renato','Nascimento Ardiles','2000-03-21','0000000000','22 rue de la petite-nuit','Cergy',95000,'France');
INSERT INTO InfoCompte VALUES ('magasin1@gmail.com','MAGASIN1','MAGASIN1','1989-05-11','0130365987','12 Allée de la Garance','PARIS',75019,'France');

