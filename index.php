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
                print "<a href=kysely.php?kysely=".$tulos['kurssikyselyid'].">".$tulos['kknimi']."</a>"."</br>";
             }

          ?>
        <br>
        <table width="300" border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
            <tr>
            <form name="form1" method="post" action="checklogin.php">
                <td>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                        <tr>
                        <td colspan="3"><strong>Kirjaudu sisään</strong></td>
                        </tr>
                        <tr>
                            <td width="78">Sähköposti</td>
                            <td width="6">:</td>
                            <td width="294"><input name="email" type="text" id="email"></td>
                        </tr>
                        <tr>
                            <td>Salasana</td>
                            <td>:</td>
                            <td><input name="salasana" type="password" id="salasana"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="Submit" value="Kirjaudu"></td>
                        </tr>
                        </table>
                    </td>
                </form>
            </tr>
        </table>
        <br></br>
	<br></br>
	<br></br>
	<br></br>
        <?php
	// kokeiluja:
	//$kirjautuminenn = True;
	//$kirjautuminen = $_POST['kirjautuminen'];
	//if ($kirjautuminen == False) {
        //echo $email;
	//}
        ?>
        </body>
