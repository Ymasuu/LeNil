

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
email varchar(150) not null,
dateNaissance date not null,
telephone int not null,
adresse varchar(250) not null,
ville varchar(50) not null,
codePostal SMALLINT not null,
pays varchar(50) not null,
motDePasse varchar(100) not null,
idCommande int,
    FOREIGN KEY (idCommande) REFERENCES Commande(id),
FOREIGN KEY (email) REFERENCES Compte(email)
);


CREATE TABLE Panier (
    id int not null PRIMARY KEY,
    HT decimal,
    TVA decimal,
    TTC decimal,
    nomClient varchar(50) not null,
    prenomClient varChar(50) not null,
    idClient int not null,
    FOREIGN KEY (idClient) REFERENCES Client(id)
);


CREATE TABLE ProduitsVendeur (
id int not null PRIMARY KEY,
QuantiteVendeur int not null,
prix decimal(10,2) not null
);

CREATE TABLE a_CommandeContientProduitVendeur(
idCommande int not null,
idProduitVendeur int not null,
PRIMARY KEY(idCommande,idProduitVendeur),
FOREIGN KEY (idCommande) REFERENCES Commande(id),
FOREIGN KEY (idProduitVendeur) REFERENCES ProduitsVendeur(id)
);


CREATE TABLE Recherche(
    motCle varchar(255) not null PRIMARY KEY
);
