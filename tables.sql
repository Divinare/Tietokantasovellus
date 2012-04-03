DROP TABLE Kommentti;
DROP TABLE Vastaus;
DROP TABLE Kysymys;
DROP TABLE Kurssikysely;
DROP TABLE Kurssi;
DROP TABLE Henkilo;

CREATE TABLE Henkilo (
henkiloID serial NOT NULL,
etunimi varchar(30) NOT NULL,
sukunimi varchar(30) NOT NULL,
email varchar(80) NOT NULL,
salasana varchar(15) NOT NULL,
rooli varchar(30) NOT NULL,
PRIMARY KEY (henkiloID)
);
CREATE TABLE Kurssi (
kurssiID numeric(10) NOT NULL,
henkiloID integer NOT NULL,
nimi varchar(50) NOT NULL,
periodi numeric(1) NOT NULL,
vuosi numeric(4) NOT NULL,
PRIMARY KEY (kurssiID),
FOREIGN KEY (henkiloID) REFERENCES Henkilo
);
CREATE TABLE Kurssikysely (
kurssikyselyID numeric(15) NOT NULL,
kurssiID numeric(10) NOT NULL,
kknimi varchar(50) NOT NULL,
henkiloID integer NOT NULL,
PRIMARY KEY (kurssikyselyID),
FOREIGN KEY (henkiloID) REFERENCES Henkilo,
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
PRIMARY KEY (vastausID),
FOREIGN KEY (kysymysID) REFERENCES Kysymys
);
CREATE TABLE Kommentti (
kommenttiID numeric(10) NOT NULL,
kommentti varchar(300) NOT NULL,
kysymysID numeric(10) NOT NULL,
FOREIGN KEY (kysymysID) REFERENCES Kysymys
);
INSERT INTO henkilo (etunimi, sukunimi, email, salasana, rooli) VALUES ('Jenna', 'Lindh', 'jelindh@cs.helsinki.fi', 'broileri', 'admin');
INSERT INTO henkilo (etunimi, sukunimi, email, salasana, rooli) VALUES ('Joe', 'Niemi', 'joeniemi@cs.helsinki.fi', 'apina', 'admin');

INSERT INTO henkilo (etunimi, sukunimi, email, salasana, rooli) VALUES ('Leidi', 'Lol', 'joeniemi@cs.helsinki.fi', 'haha', 'opettaja');
INSERT INTO henkilo (etunimi, sukunimi, email, salasana, rooli) VALUES ('Arto', 'Wikla', 'joeniemi@cs.helsinki.fi', 'roskienkeraaja', 'opettaja');

INSERT INTO kurssi VALUES (123, 4, 'Ohjelmoinnin perusteet', 4, 2012);
INSERT INTO kurssi VALUES (124, 4, 'Ohjelmoinnin jatkokurssi', 3, 2012);
INSERT INTO kurssi VALUES (125, 3, 'Johdatus funktionaaliseen ohjelmointiin', 1, 2011);

INSERT INTO kurssikysely VALUES (10000, 123, 'OhPe-kysely', 4);
INSERT INTO kurssikysely VALUES (10001, 124, 'OhJa-kysely', 4);
INSERT INTO kurssikysely VALUES (10002, 125, 'JFO-kysely', 3);

INSERT INTO kysymys VALUES (1, 'Oliko kiva kurssi?', 10000);
INSERT INTO vastaus VALUES (1, 1, 5);
INSERT INTO kysymys VALUES (2, 'Olivatko tehtävät sopivia?', 10000);
INSERT INTO kysymys VALUES (3, 'Oliko luennoitsijalla hieno paita?', 10000);
