<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Admin - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
       <?php
          $yhteys = db::getDB();
          $email = $_POST['etu'];
          $salasana = $_POST['suku'];
          echo "<h1>Admin - $etu $suku</h1>";
          ?>

          <h3>Käyttäjälista Adminit</h3>
          <table border="5" cellpadding="5">
             <tr>
                <th>Etunimi</th>
   	        <th>Sukunimi</th>
   	        <th>Sähköposti</th>
                <th>Salasana</th>
    	        <th>Rooli</th>
    	        <th>HenkilöID</th>
             </tr>
             <tr>
                <td>January</td>
                <td>$100</td>
             </tr>
          </table>

       </body>
