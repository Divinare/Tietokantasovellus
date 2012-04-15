<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Uusi kysely - Kurssi</title>
   <meta charset="utf-8">
</head>
<body>

     <h1>Valitse kurssi</h1>

    <?php
          $yhteys = db::getDB();
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
                  </Form></td>
              </tr>
       <?php } ?>
       </table>
       </br></br>
       <a href=kurssi.php?opettaja=<?php print $_GET["opettaja"]?>>Lisää uusi kurssi</a>

</body>
