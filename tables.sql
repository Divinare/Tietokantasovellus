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
INSERT INTO henkilo VALUES ('Jenna', 'Lindh', 'jelindh@cs.helsinki.fi', 'broileri', 'admin');
INSERT INTO henkilo VALUES ('Joe', 'Niemi', 'joeniemi@cs.helsinki.fi', 'apina', 'admin');

INSERT INTO henkilo VALUES ('Leidi', 'Lol', 'joeniemi@cs.helsinki.fi', 'haha', 'opettaja');
INSERT INTO henkilo VALUES ('Arto', 'Wikla', 'joeniemi@cs.helsinki.fi', 'roskienkeraaja', 'opettaja');

INSERT INTO kurssi VALUES (4, 'Ohjelmoinnin perusteet', 4, 2012);
INSERT INTO kurssi VALUES (4, 'Ohjelmoinnin jatkokurssi', 3, 2012);
INSERT INTO kurssi VALUES (3, 'Johdatus funktionaaliseen ohjelmointiin', 1, 2011);

INSERT INTO kurssikysely VALUES (1, 'OhPe-kysely', 4);
INSERT INTO kurssikysely VALUES (2, 'OhJa-kysely', 4);
INSERT INTO kurssikysely VALUES (3, 'JFO-kysely', 3);

INSERT INTO kysymys VALUES ('Oliko kurssi mukava?', 1);
INSERT INTO kysymys VALUES ('Olivatko tehtävät sopivia?', 1);
INSERT INTO kysymys VALUES ('Oliko luennoitsijalla hieno paita?', 1);
