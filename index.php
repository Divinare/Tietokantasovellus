
<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Kurssikysely </title>
   <meta charset="utf-8">
</head>
        <body>

          <?php
             $yhteys = db::getDB();
             echo "<h1>Käynnissä olevat kurssikyselyt</h1></br>";


             $kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely ORDER BY kknimi';
             foreach ($yhteys->query($kysely) as $tulos) {
                print "<a href=http://jelindh.users.cs.helsinki.fi/kysely.php?kysely=".$tulos['kurssikyselyid'].">".$tulos['kknimi']."</a>"."</br>";
             }

          ?>
	  <h5>Sähköposti</h5>
          <input type="text" name="nimi">
          <br>
          <h5>Salasana</h5>
          <input type="passowrd" name="nimi">
          <br>
          <input type="submit" value="Kirjaudu sisään">
          <br>
        </body>

