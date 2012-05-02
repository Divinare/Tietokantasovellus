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

INSERT INTO kurssi VALUES (6, 'Ohjelmoinnin perusteet', 4, 2012);
INSERT INTO kurssi VALUES (6, 'Ohjelmoinnin jatkokurssi', 3, 2012);
INSERT INTO kurssi VALUES (4, 'Johdatus funktionaaliseen ohjelmointiin', 4, 2012);
INSERT INTO kurssi VALUES (6, 'Nenän niistämisen alkeet', 1, 2008);

INSERT INTO kurssikysely VALUES (1, 'OhPe kysely', 6, TRUE, TRUE);
INSERT INTO kurssikysely VALUES (2, 'OhJa-kysely', 6, TRUE, TRUE);
INSERT INTO kurssikysely VALUES (3, 'JFO-kysely', 4, TRUE, TRUE);
INSERT INTO kurssikysely VALUES (4, 'NNA-kysely', 6, FALSE, TRUE); 

INSERT INTO kysymys VALUES ('Arvioi kurssin mielekkyyttä asteikolla 1-5.', 1);
INSERT INTO kysymys VALUES ('Olivatko tehtävät sopivia?', 1);
INSERT INTO kysymys VALUES ('Oliko luennoitsijalla hieno paita?', 1);
INSERT INTO kysymys VALUES ('Minkä arvosanan annat kurssista?', 1);
INSERT INTO kysymys VALUES ('Miten tylsää luennoilla oli?', 2);
INSERT INTO kysymys VALUES ('Opitko mitään kurssista?', 2);
INSERT INTO kysymys VALUES ('Kävitkö luennoilla? (1 = et kertaakaan, 5 = aina)', 2);
INSERT INTO kysymys VALUES ('Minkä arvosanan annat kurssista?', 2);
INSERT INTO kysymys VALUES ('Olivatko tehtävät haasteellisia?', 3);
INSERT INTO kysymys VALUES ('Mitkä fiilikset? (1 = huonot, 5 = mahtavat)', 3);
INSERT INTO kysymys VALUES ('Osaatko nyt ohjelmoida funktionaalisesti? (1 = et :(, 5 = täydellisesti)', 3);
INSERT INTO kysymys VALUES ('Minkä arvosanan annat kurssista?', 3);
INSERT INTO kysymys VALUES ('Opitko niistämään nenäsi?', 4);
INSERT INTO kysymys VALUES ('Aiotko ottaa nenän niistämisen syventävän jatkokurssin?', 4);
INSERT INTO kysymys VALUES ('Hyödyitkö kurssista?', 4);

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
INSERT INTO vastaus VALUES (9, 1);
INSERT INTO vastaus VALUES (9, 2);
INSERT INTO vastaus VALUES (9, 2);
INSERT INTO vastaus VALUES (9, 5);
INSERT INTO vastaus VALUES (10, 1);
INSERT INTO vastaus VALUES (10, 4);
INSERT INTO vastaus VALUES (10, 5);
INSERT INTO vastaus VALUES (10, 5);
INSERT INTO vastaus VALUES (11, 1);
INSERT INTO vastaus VALUES (11, 4);
INSERT INTO vastaus VALUES (11, 5);
INSERT INTO vastaus VALUES (12, 3);
INSERT INTO vastaus VALUES (13, 4);
INSERT INTO vastaus VALUES (13, 4);
INSERT INTO vastaus VALUES (13, 4);
INSERT INTO vastaus VALUES (14, 1);
INSERT INTO vastaus VALUES (14, 5);
INSERT INTO vastaus VALUES (15, 2);
INSERT INTO vastaus VALUES (15, 2);
INSERT INTO vastaus VALUES (15, 3);

INSERT INTO kommentti VALUES ('Kurssi oli ihan jees.', 1);
INSERT INTO kommentti VALUES ('Liian työläs, ei ollu!', 1);
INSERT INTO kommentti VALUES ('Ei!!!11', 2);
INSERT INTO kommentti VALUES ('Vähä liian kiree mun makuun :P', 3);
INSERT INTO kommentti VALUES ('Tyhmään kysymykseen tyhmä vastaus', 3);
INSERT INTO kommentti VALUES ('En kiinnittäny huomiota, tämä paha? xDDDD', 3);
INSERT INTO kommentti VALUES ('Varmaa te tällästä kysytte -___-', 3);
INSERT INTO kommentti VALUES ('Asteikolla 1-5 antaisin 6.', 4);
INSERT INTO kommentti VALUES ('Ei, pelasin miinaharavaa ^^', 5);
INSERT INTO kommentti VALUES ('Opin tajuamaan kuinka paljon mulla on vielä opittavaa', 6);
INSERT INTO kommentti VALUES ('En, koska moon koodannu 10v javaa työkseni', 6);
INSERT INTO kommentti VALUES ('Opin tekemään if-lauseen!', 6);
INSERT INTO kommentti VALUES ('Olisin käyny mut olin kipee koko periodin', 7);
INSERT INTO kommentti VALUES ('En, jäi joululomafiilis päälle eikä pygenny :DDD', 7);
INSERT INTO kommentti VALUES ('Osa tehtävistä oli mahdottomia', 9);
INSERT INTO kommentti VALUES ('Ei, tein kaikki tehtävät 10 eri ohjelmointikielellä kun oli tylsää ja liian helppoa. Voisitte jatkossa laittaa vähän haasteellisempia kysymyksiä', 10);
INSERT INTO kommentti VALUES ('Riippuu arvosanasta.', 10);
INSERT INTO kommentti VALUES ('Kiinnostava kurssi oli.', 12); 
INSERT INTO kommentti VALUES ('En päässyt edes kokeesta läpi', 13);
INSERT INTO kommentti VALUES ('Ehdottomasti, se on hieno meriitti CV:ssä', 14);
