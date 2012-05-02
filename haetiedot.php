<?php
// Haetaan tietyn kurssikyselyid:n perusteella siihen liittyvä henkilön etu- ja sukunimi, kurssinnimi, vuosi ja periodi
require_once 'DB.php';
session_start();

                   // Haetaan kurssikyselyyn liittyvä henkiloid ja kurssiid
                    $sqltk = 'SELECT henkiloid, kurssiid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
                    $sqltk3 = $sqltk2->fetchAll();
                    // Haetaan henkilön nimi henkiloID:n avulla (joka siis saadaan $sqltk3[0][0])
                    $sqln = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
                    $sqln2 = $yhteys->prepare($sqln);
                    $sqln2->execute(array($sqltk3[0][0]));
                    $sqln3 = $sqln2->fetchAll();
                    // Haetaan kurssin nimi, vuosi ja periodi kurssiID:n avulla (joka saadaan $sqltk3[0][1])
                    $sqlnpv = 'SELECT nimi, vuosi, periodi FROM kurssi WHERE kurssiid = ?';
                    $sqlnpv2 = $yhteys->prepare($sqlnpv);
                    $sqlnpv2->execute(array($sqltk3[0][1]));
                    $sqlnpv3 = $sqlnpv2->fetchAll();


?>
