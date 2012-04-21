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
salasana varchar(15) NOT NULL,
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
INSERT INTO henkilo VALUES ('Jenna', 'Lindh', 'jippii', 'broileri', 'admin');
INSERT INTO henkilo VALUES ('Joe', 'Niemi', 'jihuu', 'apina', 'admin');
INSERT INTO henkilo VALUES ('testihenkilö', 'testaaja', '1', '1', 'admin');

INSERT INTO henkilo VALUES ('Leidi', 'Lol', 'roflmao', 'haha', 'opettaja');
INSERT INTO henkilo VALUES ('Arto', 'Wikla', 'wikla', 'roskienkeraaja', 'opettaja');
INSERT INTO henkilo VALUES ('testihenkilö2', 'testaaja2', '2', '2', 'opettaja');

INSERT INTO henkilo VALUES ('Jorma', 'Uotinen', 'luukku', 'lol', 'vastuuhenkilö');
INSERT INTO henkilo VALUES ('testihenkilö3', 'testaaja3', '3', '3', 'vastuuhenkilö');

INSERT INTO kurssi VALUES (4, 'Ohjelmoinnin perusteet', 4, 2012);
INSERT INTO kurssi VALUES (4, 'Ohjelmoinnin jatkokurssi', 3, 2012);
INSERT INTO kurssi VALUES (3, 'Johdatus funktionaaliseen ohjelmointiin', 1, 2011);

INSERT INTO kurssikysely VALUES (1, 'OhPe-kysely', 4, TRUE);
INSERT INTO kurssikysely VALUES (2, 'OhJa-kysely', 4, TRUE);
INSERT INTO kurssikysely VALUES (3, 'JFO-kysely', 3, TRUE);

INSERT INTO kysymys VALUES ('Oliko kurssi mukava?', 1);
INSERT INTO kysymys VALUES ('Olivatko tehtävät sopivia?', 1);
INSERT INTO kysymys VALUES ('Oliko luennoitsijalla hieno paita?', 1);
INSERT INTO kysymys VALUES ('Oliks tylsää luennoil?', 2);
INSERT INTO kysymys VALUES ('Opitko mitään koko kurssista?', 2);
INSERT INTO kysymys VALUES ('Kävitkö edes luennoilla? 0 = et kertaakaan, 5 = aina', 2);
INSERT INTO kysymys VALUES ('Oliko tehtävät haasteellisia?', 3);
INSERT INTO kysymys VALUES ('Onko nyt hyvä mieli?', 3);

INSERT INTO vastaus VALUES (1, 5);
INSERT INTO vastaus VALUES (1, 5);
INSERT INTO vastaus VALUES (1, 4);
INSERT INTO vastaus VALUES (1, 4);
INSERT INTO vastaus VALUES (1, 3);
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
INSERT INTO vastaus VALUES (4, 1);
INSERT INTO vastaus VALUES (5, 2);
INSERT INTO vastaus VALUES (6, 3);
INSERT INTO vastaus VALUES (7, 2);
INSERT INTO vastaus VALUES (8, 1);
INSERT INTO vastaus VALUES (8, 1);
INSERT INTO vastaus VALUES (8, 2);
INSERT INTO vastaus VALUES (8, 2);
