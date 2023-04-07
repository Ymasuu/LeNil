

DROP DATABASE IF EXISTS Marketplace;  -- creer la base avant
CREATE DATABASE Marketplace;
USE Marketplace;  -- se connecter a la base

DROP TABLE IF EXISTS Client;  -- rajouter IF EXISTS
DROP TABLE IF EXISTS Panier;
DROP TABLE IF EXISTS Colis;
DROP TABLE IF EXISTS Commande;
DROP TABLE IF EXISTS ProduitsVendeur;
DROP TABLE IF EXISTS Recherche;
DROP TABLE IF EXISTS Produit;

CREATE TABLE Colis (
    id int not null PRIMARY KEY,
    longueur SMALLINT CHECK (longueur > 0),
    hauteur SMALLINT CHECK (hauteur > 0),
    poids SMALLINT CHECK (poids > 0)
);



CREATE TABLE Commande (
    id int not null PRIMARY KEY,
    totalPayer int CHECK (not(totalPayer < 0)),
    modePayment varchar(20),
    datePayment date,
    idColis int REFERENCES Colis(id)
    

);

CREATE TABLE Client (
    email varchar(150) not null PRIMARY KEY,
    prenom varchar(50) not null,
    nom varchar(50) not null,
    dateNaissance date not null,
    telephone int not null,
    adresse varchar(250) not null,
    ville varchar(50) not null,
    codePostal SMALLINT not null,
    pays varchar(50) not null,
    motDePasse varchar(100) not null,
    idCommande int REFERENCES Commande(id)
);


CREATE TABLE Panier (
    id int not null PRIMARY KEY,
    HT decimal,
    TVA decimal,
    TTC decimal,
    emailClient varchar(150) REFERENCES Client(email)
    
);



CREATE TABLE ProduitsVendeur (
    id int not null PRIMARY KEY,
    QuantiteVendeur int not null,
    prix decimal not null,
    idPanier int REFERENCES Panier(id)
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
