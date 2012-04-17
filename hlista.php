<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Admin - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
          <?php
          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid =?';
          $admin = $yhteys->prepare($sql);
          $admin->execute(array($_GET['hlista']));
	  $nimi = $admin->fetch();
          echo "<h1>Admin - $nimi[0] $nimi[1]</h1>";

          // Haetaan tietokannasta kaikki adminit,opettajat,laitosvastuuhenkilöt taulukoihin
          $kysely = 'SELECT etunimi, sukunimi, email, rooli, henkiloID FROM henkilo WHERE rooli= ?';
          $kyselyadmin = $yhteys->prepare($kysely);

          $kyselyadmin->execute(array(admin));
          $Adminit = $kyselyadmin->fetchAll();

          $kyselyadmin->execute(array(opettaja));
          $Opettajat = $kyselyadmin->fetchAll();

          $kyselyadmin->execute(array(laitosva));
          $Vastuuhenkilöt = $kyselyadmin->fetchAll();

          $nimiT = $Adminit;
          $nimi = adminit;
          $nimi2 = admin;
          for ($rooli = 1; $rooli < 4; $rooli++) {
	  ?>
          <h3>Käyttäjälista <?php print $nimi ?></h3>
          <table border="5" cellpadding="5">
             <tr>
                <th align = left>Etunimi</th>
   	        <th align = left>Sukunimi</h>
                <th align = left>Sähköposti</th>
    	        <th align = left>Rooli</th>
    	        <th align = left>HenkilöID</th>
             </tr>
             <tr>
             <?php for ($i = 0, $size = sizeof($nimiT); $i < $size; ++$i) { ?>
                <td><?php print $nimiT[$i][0];?></td>
                <td><?php print $nimiT[$i][1];?></td>
	        <td><?php print $nimiT[$i][2];?></td>
                <td><?php print $nimi2?></td>
                <td><?php print $nimiT[$i][4];?></td>
             </tr>
             <?php } ?>
          </table>
          <?php
          if ($rooli == 1) {
          $nimiT = $Opettajat;
          $nimi = opettajat;
          $nimi2 = opettaja;
          }
          if ($rooli == 2) {
          $nimiT = $Vastuuhenkilöt;
          $nimi = vastuuhenkilöt;
          $nimi2 = vastuuhenkilö;
          }
	  }
          ?>

        <p> <a href=admin.php?admin=<?php print $_GET['hlista']; ?>>Takaisin</a></p>

       </body>
