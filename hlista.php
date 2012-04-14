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
          $adminit = $kyselyadmin->fetchAll();
          ?>

          <h3>Käyttäjälista Adminit</h3>
          <table border="5" cellpadding="5">
             <tr>
                <th align = left>Etunimi</th>
   	        <th align = left>Sukunimi</h>
                <th align = left>Sähköposti</th>
    	        <th align = left>Rooli</th>
    	        <th align = left>HenkilöID</th>
             </tr>
             <tr>
                <td><?php print $adminit[1][0];?></td>
                <td><?php print $adminit[1][1];?></td>
	        <td><?php print $adminit[1][2];?></td>
                <td>admin</td>
                <td><?php print $adminit[1][4];?></td>
                <td><?php print $adminit[0][1];?></td>
	        <td><?php print $adminit[0][2];?></td>
                <td><?php print $adminit[0][3];?></td>
             </tr>
          </table>

       </body>
