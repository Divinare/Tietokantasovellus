DROP TABLE Admin;
DROP TABLE Vastaus;
DROP TABLE Kysymys;
DROP TABLE Kurssikysely;
DROP TABLE Kurssi;
DROP TABLE Opettaja;
DROP TABLE Tunnus;


CREATE TABLE Tunnus (
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
FOREIGN KEY (tunnusID) REFERENCES Tunnus
);
CREATE TABLE Kurssi (
kurssiID numeric(15) NOT NULL,
opettajaID numeric(4) NOT NULL,
nimi varchar(50) NOT NULL,
periodi numeric(1) NOT NULL,
vuosi numeric(4) NOT NULL,
PRIMARY KEY (kurssiID),
FOREIGN KEY (opettajaID) REFERENCES Opettaja
);
CREATE TABLE Kurssikysely (
kurssikyselyID numeric(15) NOT NULL,
kurssiID numeric(15) NOT NULL,
kknimi varchar(50) NOT NULL,
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
FOREIGN KEY (tunnusID) REFERENCES Tunnus
);
INSERT INTO tunnus VALUES (1001, 'broileri');
INSERT INTO tunnus VALUES (1000, 'apina');
INSERT INTO admin VALUES (7777, 1001, 'Jenna', 'Lindh', 'jelindh@cs.helsinki.fi');
INSERT INTO admin VALUES (5555, 1000, 'Joe', 'Niemi', 'joeniemi@cs.helsinki.fi');

INSERT INTO tunnus VALUES (1002, 'lol');
INSERT INTO opettaja VALUES (1000, 'Matti', 'Meikäläinen', 1002, 'joeniemi@cs.helsinki.fi');

INSERT INTO kurssi VALUES (123, 1000, 'Ohjelmoinnin perusteet', 4, 2012);
INSERT INTO kurssi VALUES (124, 1000, 'Ohjelmoinnin jatkokurssi', 3, 2012);
INSERT INTO kurssi VALUES (125, 1000, 'Johdatus funktionaaliseen ohjelmointiin', 1, 2011);

INSERT INTO kurssikysely VALUES (10000, 123, 'Ohpe-kysely');
INSERT INTO kysymys VALUES (1, 'Oliko kiva kurssi?', 10000);
INSERT INTO vastaus VALUES (1, 1, 5, 'Oli kiva kurssi, lisää tälläisiä kiitos!');
INSERT INTO kysymys VALUES (2, 'Olivatko tehtävät sopivia?', 10000);
INSERT INTO kysymys VALUES (3, 'Oliko luennoitsijalla hieno paita?', 10000);

