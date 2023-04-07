

DROP DATABASE IF EXISTS Marketplace;  -- creer la base avant
CREATE DATABASE Marketplace;
USE Marketplace;  -- se connecter a la base

DROP TABLE IF EXISTS Client;  -- rajouter IF EXISTS
DROP TABLE IF EXISTS Panier;
DROP TABLE IF EXISTS Colis;
DROP TABLE IF EXISTS Commande;
DROP TABLE IF EXISTS ProduitsVendeur;
DROP TABLE IF EXISTS Recherche;
<<<<<<< HEAD

CREATE TABLE Colis (
id int not null PRIMARY key,
longueur SMALLINT CHECK (longueur > 0),
hauteur SMALLINT CHECK (hauteur > 0),
poids SMALLINT CHECK(poids > 0)
);


CREATE TABLE Commande (
    id int not null PRIMARY KEY,
    totalPayer int CHECK (not(totalPayer < 0)),
    modePayment varchar(20),
    datePayment date,
    idColis int,
    FOREIGN KEY (idColis) REFERENCES Colis(id)

);



CREATE TABLE Compte(
    email varchar(100) PRIMARY KEY,
    motDePasse varchar(50) not null,
    abonnement BIT,
    signatureContratClient BIT,
    signatureContratVendeur BIT 
);

CREATE TABLE Client (
    id int not null PRIMARY KEY,
prenom varchar(50) not null,
nom varchar(50) not null,
emailCompte varchar(150) not null,
dateNaissance date not null,
telephone int not null,
adresse varchar(250) not null,
ville varchar(50) not null,
codePostal SMALLINT not null,
pays varchar(50) not null,
motDePasse varchar(100) not null,
idCommande int,
    FOREIGN KEY (idCommande) REFERENCES Commande(id),
FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);


CREATE TABLE Panier (
    id int not null PRIMARY KEY,
    HT decimal,
    TVA decimal,
    TTC decimal,
    idClient int not null,
    FOREIGN KEY (idClient) REFERENCES Client(id)
);


CREATE TABLE ProduitsVendeur (
id int not null PRIMARY KEY,
QuantiteVendeur int not null,
prix decimal(10,2) not null,
idPanier int,
FOREIGN KEY(idPanier) REFERENCES Panier(id)
);

CREATE TABLE a_CommandeContientProduitVendeur(
idCommande int not null,
idProduitVendeur int not null,
PRIMARY KEY(idCommande,idProduitVendeur),
FOREIGN KEY (idCommande) REFERENCES Commande(id),
FOREIGN KEY (idProduitVendeur) REFERENCES ProduitsVendeur(id)
);

CREATE TABLE NombrePanier (
    id int not null PRIMARY KEY,
    QuantitePanier int not null,
    idPanier int REFERENCES Panier(id),
    idProduitVendeur int REFERENCES Panier(id)
);

CREATE TABLE Recherche(
    motCle varchar(255) not null PRIMARY KEY
);

CREATE TABLE Caracteristique(
    id int not null PRIMARY KEY,
    valeur varchar(10) not null,
    nom varchar(50) not null
);

CREATE TABLE Produit(
    id int not null PRIMARY KEY,
    description varchar(255) not null,
    idCaracteristique int REFERENCES Caracteristique(id)
);

CREATE TABLE Contrat(
numero int not null Primary Key,
texte varchar(255),
emailCompte varchar(100),
FOREIGN KEY (emailCompte) REFERENCES Compte(email)
);

CREATE TABLE MoyenPayment(
    id int not null Primary key,
    modePayment ENUM('paypal', 'cb')
);

CREATE TABLE a_payePar(
emailCompte varchar(50) not null,
idMoyenPayment int not null,
Primary KEY (emailCompte,idMoyenPayment),
FOREIGN KEY (emailCompte) REFERENCES Compte(email),
FOREIGN KEY (idMoyenPayment) REFERENCES MoyenPayment(id)
);

CREATE TABLE Adresse(
id int PRYMARY KEY AUTO_INCREMENT,
numeroRue varchar(255) not null,
nomRue varchar(255),
codePostal SMALLINT not null,
ville varchar(100) not null,
pays varchar(50),
complementAdresse varchar(255),
idCommande int not null,
FOREIGN KEY (idCommande) REFERENCES Commande(id)
);

CREATE TABLE QuantiteCommande (
    id INT NOT NULL PRIMARY KEY,
    quantite DECIMAL(2)
);


--Table de la relation ternaire
CREATE TABLE Adresse_Commande_QuantiteCommande(
idAdresse int not null,
idCommande int not null,
idQuantiteCommande int not null,
PRIMARY KEY (idAdresse,idCommande,idQuantiteCommande),
Foreign KEY (idAdresse) REFERENCES Adresse(id),
FOREIGN KEY (idCommande) REFERENCES Commande(id),
FOREIGN KEY (idQuantiteCommande) REFERENCES QuantiteCommande(id)
);
