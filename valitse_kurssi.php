<?php
     require_once 'DB.php';
     session_start();
     $yhteys = db::getDB();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<head>
   <title>Uusi kysely - Kurssi</title>
   <meta charset="utf-8">
</head>
<body>

     <h1>Valitse kurssi</h1>

    <?php
          // Istuntotarkastus
          if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

              $sql = 'SELECT nimi, vuosi, periodi, kurssiID FROM kurssi WHERE henkiloID = ?';
              $kurssi = $yhteys->prepare($sql);
              $kurssi->execute(array($_GET["opettaja"]));
              $kurssit = $kurssi->fetchAll();
    ?>

    <table border="0" cellpadding="3">
       <tr>
       <th align = left>Nimi</th>
       <th align = left>Periodi</th>
       <th align = left>Vuosi  </th>
       <th>                 </th>
       <th>                 </th>
       </tr>
       <tr>

       <?php

           foreach ($kurssit as $k) {

        ?>
              <td><?php print $k['nimi'];?></td>
              <td><?php print $k['periodi'];?></td>
              <td><?php print $k['vuosi'];?></td>
              <td><Form  action="luo_kysely.php?opettaja=<?php print $_GET['opettaja'];?>" method="post">
                  <input type="hidden" name="knimi" value="<?php print $k['nimi'];?>">
                  <input type="hidden" name="periodi" value="<?php print $k['periodi'];?>">
                  <input type="hidden" name="vuosi" value="<?php print $k['vuosi'];?>">
                  <input type="submit" value="Valitse">
                  </Form>
              </td>
              <td><Form  action="poista_kurssi.php?opettaja=<?php print $_GET['opettaja'];?>" method="post">
                  <input type="hidden" name="kurssiid" value="<?php print $k['kurssiid'];?>">
                  <input type="submit" value="Poista">
                  </Form>
              </td>
              </tr>
       <?php
          }
        ?>
       </table>
       </br>
       <?php

          if ($_GET["viesti"] == "OK!") {
             print "<p><font color='Red'>    Poisto onnistui!</p>";
          }
          else if ($_GET["viesti"] == "v") {
             print "<p><font color='Red'>    Kurssiin, jonka yritit poistaa, liittyy kurssikyselyitä. Poista ensin kurssiin liittyvät kurssikyselyt ja yritä sitten uudelleen.</p>";
          }

       ?>
       </br>
       <p><a href=kurssi.php?opettaja=<?php print $_GET["opettaja"]?>>Lisää uusi kurssi</a></p>
       <p><a href=opettaja.php?opettaja=<?php print $_GET["opettaja"]?>>Takaisin</a></p>

      <?php

          }
          else {
             header("Location: access_denied.php"); die();
          }
      ?>
</body>
