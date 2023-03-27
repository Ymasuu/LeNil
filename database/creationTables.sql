--Les tables doivent etre crées dans l'ordre suivante:

CREATE TABLE Colis (
id int not null PRIMARY key,
longueur SMALLINT CHECK (longueur > 0),
hauteur SMALLINT CHECK (hauteur > 0);
poids SMALLINT CHECK(poids > 0)
);

CREATE TABLE Commande (
    id int not null PRIMARY KEY,
    totalPayer int CHECK (not(totalPayer < 0)),
    modePayment varchar(20),
    datePayment date,
    idColis int FOREIGN KEY REFERENCES Colis(id),

);

CREATE TABLE Client (
prenom varchar(50) not null,
nom varchar(50) not null,
email varchar(150) not null PRIMARY KEY,
dateNaissance date not null,
telephone int not null,
adresse varchar(250) not null,
ville varchar(50) not null,
codePostal SMALLINT not null,
pays varchar(50) not null,
motDePasse varchar(100) not null,
idCommande int,
    FOREIGN KEY (idCommande) REFERENCES Commande(id)
);

CREATE TABLE RECHRCHE(
    motCle varchar(255) not null PRIMARY KEY,
    
);

