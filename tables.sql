DROP TABLE Kommentti;
DROP TABLE Vastaus;
DROP TABLE Kysymys;
DROP TABLE Kurssikysely;
DROP TABLE Kurssi;
DROP TABLE Henkilo;

CREATE TABLE Henkilo (
etunimi varchar(30) NOT NULL,
sukunimi varchar(30) NOT NULL,
email varchar(80) NOT NULL,
salasana varchar(60) NOT NULL,
rooli varchar(30) NOT NULL,
henkiloID serial NOT NULL,
PRIMARY KEY (henkiloID)
);
CREATE TABLE Kurssi (
henkiloID integer NOT NULL,
nimi varchar(50) NOT NULL,
periodi numeric(1) NOT NULL,
vuosi numeric(4) NOT NULL,
kurssiID serial NOT NULL,
PRIMARY KEY (kurssiID),
FOREIGN KEY (henkiloID) REFERENCES Henkilo
);
CREATE TABLE Kurssikysely (
kurssiID integer NOT NULL,
kknimi varchar(50) NOT NULL,
henkiloID integer NOT NULL,
esilla boolean NOT NULL,
ollutEsilla boolean NOT NULL,
kurssikyselyID serial NOT NULL,
PRIMARY KEY (kurssikyselyID),
FOREIGN KEY (henkiloID) REFERENCES Henkilo,
FOREIGN KEY (kurssiID) REFERENCES Kurssi
);
CREATE TABLE Kysymys (
kysymys varchar(300) NOT NULL,
kurssikyselyID integer NOT NULL,
kysymysID serial NOT NULL,
PRIMARY KEY (kysymysID),
FOREIGN KEY (kurssikyselyID) REFERENCES Kurssikysely
);
CREATE TABLE Vastaus (
kysymysID integer NOT NULL,
vastausarvo numeric (1) NOT NULL,
vastausID serial NOT NULL,
PRIMARY KEY (vastausID),
FOREIGN KEY (kysymysID) REFERENCES Kysymys
);
CREATE TABLE Kommentti (
kommentti varchar(300) NOT NULL,
kysymysID integer NOT NULL,
kommenttiID serial NOT NULL,
PRIMARY KEY (kommenttiID),
FOREIGN KEY (kysymysID) REFERENCES Kysymys
);
INSERT INTO henkilo VALUES ('Jenna', 'Lindh', 'jippii', '221c0a20e7a30c2835c1b3fcaa432e7a', 'admin');
INSERT INTO henkilo VALUES ('Joe', 'Niemi', 'jihuu', '48ece95de0e6393b476eaac1bbeb1390', 'admin');
INSERT INTO henkilo VALUES ('Terho', 'Pellervo', '1', 'cf749c3d7f3e6251e1eed022c2c88a5a', 'admin');

INSERT INTO henkilo VALUES ('Leidi', 'Lol', 'roflmao', '1fc1f6ee27300e5533aa172e727c4e33', 'opettaja');
INSERT INTO henkilo VALUES ('Arto', 'Wikla', 'wikla', '56f5f303e29b42dd212a56dd60bd2521', 'opettaja');
INSERT INTO henkilo VALUES ('Risto', 'Räkä', '2', '29623418a18355aad1fd430208110931', 'opettaja');

INSERT INTO henkilo VALUES ('Jorma', 'Uotinen', 'luukku', 'bb0672262584c582751df3358c795445', 'vastuuhenkilö');
INSERT INTO henkilo VALUES ('Laiska', 'Mato', '3', 'fc9f7a3782985cf2998bc25e27f24c2e', 'vastuuhenkilö');

INSERT INTO kurssi VALUES (4, 'Ohjelmoinnin perusteet', 4, 2012);
INSERT INTO kurssi VALUES (4, 'Ohjelmoinnin jatkokurssi', 3, 2012);
INSERT INTO kurssi VALUES (3, 'Johdatus funktionaaliseen ohjelmointiin', 1, 2011);

INSERT INTO kurssikysely VALUES (1, 'OhPe-kysely', 4, TRUE, TRUE);
INSERT INTO kurssikysely VALUES (2, 'OhJa-kysely', 4, TRUE, TRUE);
INSERT INTO kurssikysely VALUES (3, 'JFO-kysely', 3, TRUE, TRUE);

INSERT INTO kysymys VALUES ('Oliko kurssi mukava?', 1);
INSERT INTO kysymys VALUES ('Olivatko tehtävät sopivia?', 1);
INSERT INTO kysymys VALUES ('Oliko luennoitsijalla hieno paita?', 1);
INSERT INTO kysymys VALUES ('Minkä arvosanan annat kurssista?', 1);
INSERT INTO kysymys VALUES ('Oliks tylsää luennoilla?', 2);
INSERT INTO kysymys VALUES ('Opitko mitään koko kurssista?', 2);
INSERT INTO kysymys VALUES ('Kävitkö edes luennoilla? 0 = et kertaakaan, 5 = aina', 2);
INSERT INTO kysymys VALUES ('Minkä arvosanan annat kurssista?', 2);
INSERT INTO kysymys VALUES ('Oliko tehtävät haasteellisia?', 3);
INSERT INTO kysymys VALUES ('Mitkä fiilikset? 0 = huonot, 5 = mahtavat', 3);
INSERT INTO kysymys VALUES ('Osaatko nyt ohjelmoida funktionaalisesti? 0 = et :(, 5 = täydellisesti', 3);
INSERT INTO kysymys VALUES ('Minkä arvosanan annat kurssista?', 3);

INSERT INTO vastaus VALUES (1, 5);
INSERT INTO vastaus VALUES (1, 5);
INSERT INTO vastaus VALUES (1, 4);
INSERT INTO vastaus VALUES (1, 4);
INSERT INTO vastaus VALUES (1, 3);
INSERT INTO vastaus VALUES (1, 1);
INSERT INTO vastaus VALUES (1, 1);
INSERT INTO vastaus VALUES (1, 1);
INSERT INTO vastaus VALUES (2, 5);
INSERT INTO vastaus VALUES (2, 5);
INSERT INTO vastaus VALUES (2, 3);
INSERT INTO vastaus VALUES (2, 1);
INSERT INTO vastaus VALUES (2, 1);
INSERT INTO vastaus VALUES (2, 1);
INSERT INTO vastaus VALUES (2, 1);
INSERT INTO vastaus VALUES (3, 5);
INSERT INTO vastaus VALUES (3, 2);
INSERT INTO vastaus VALUES (3, 3);
INSERT INTO vastaus VALUES (4, 1);
INSERT INTO vastaus VALUES (4, 1);
INSERT INTO vastaus VALUES (5, 2);
INSERT INTO vastaus VALUES (6, 3);
INSERT INTO vastaus VALUES (7, 2);
INSERT INTO vastaus VALUES (8, 1);
INSERT INTO vastaus VALUES (8, 1);
INSERT INTO vastaus VALUES (8, 2);
INSERT INTO vastaus VALUES (8, 2);
