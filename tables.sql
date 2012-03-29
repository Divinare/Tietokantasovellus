CREATE TABLE Tunnukset (
tunnusID numeric(4) NOT NULL,
salasana varchar(15) NOT NULL,
PRIMARY KEY (tunnusID)
);
CREATE TABLE Opettaja (
opettajaID numeric(4) NOT NULL,
etunimi varchar(30) NOT NULL,
sukunimi varchar(30) NOT NULL,
tunnusID numeric(4) NOT NULL,
email varchar(80) NOT NULL,
PRIMARY KEY (opettajaID),
FOREIGN KEY (tunnusID) REFERENCES Tunnukset
);
CREATE TABLE Kurssi (
kurssiID numeric(15) NOT NULL,
opettajaID numeric(4) NOT NULL,
nimi varchar(50) NOT NULL,
periodi numeric(1) NOT NULL,
vuosi numeric(4) NOT NULL,
email varchar(80) NOT NULL,
PRIMARY KEY (kurssiID),
FOREIGN KEY (opettajaID) REFERENCES Opettaja
);
CREATE TABLE Kurssikysely (
kurssikyselyID numeric(15) NOT NULL,
kurssiID numeric(15) NOT NULL,
PRIMARY KEY (kurssikyselyID),
FOREIGN KEY (kurssiID) REFERENCES Kurssi
);
CREATE TABLE Kysymys (
kysymysID numeric(10) NOT NULL,
kysymys varchar(300) NOT NULL,
kurssikyselyID numeric(15) NOT NULL,
PRIMARY KEY (kysymysID),
FOREIGN KEY (kurssikyselyID) REFERENCES Kurssikysely
);
CREATE TABLE Vastaus (
vastausID numeric(10) NOT NULL,
kysymysID numeric(10) NOT NULL,
vastausarvo numeric (1) NOT NULL,
kommentti varchar(300),
PRIMARY KEY (vastausID),
FOREIGN KEY (kysymysID) REFERENCES Kysymys
);
CREATE TABLE Admin (
adminID numeric(4) NOT NULL,
tunnusID numeric(4) NOT NULL,
etunimi varchar(30) NOT NULL,
sukunimi varchar(30) NOT NULL,
email varchar(80) NOT NULL,
PRIMARY KEY (adminID),
FOREIGN KEY (tunnusID) REFERENCES Tunnukset
);
