<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Kurssikysely </title>
   <meta charset="utf-8">
</head>
   <h1>Käynnissä olevat kurssikyselyt</h1></br>
       <?php
             $yhteys = db::getDB();

             $kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely ORDER BY kknimi';
             foreach ($yhteys->query($kysely) as $tulos) {
                print "<a href=kysely.php?kysely=".$tulos['kurssikyselyid'].">".$tulos['kknimi']."</a>"."</br>";
             }

       ?>
<body>
       <br><br>
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
        </br></br></br></br></br></br>
        <?php
             if ($_GET["m"] == "kurjuus") {
                print "<font color='red'><p>Antamasi käyttäjätunnus ja salasana eivät täsmää.</p>";
             }
        ?>
</body>
<?php


// Kokeilua



$salasana = 1;
$tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");
echo "1   ".$tiiviste."</br>";

$salasana = 2;
$tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");
echo  "2   ".$tiiviste."</br>";

$salasana = 3;
$tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");
echo  "3   ".$tiiviste."</br>";

$salasana = "lol";
$tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");
echo  "lol  ".$tiiviste."</br>";


$salasana = "broileri";
$tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");
echo  "broileri  ".$tiiviste."</br>";

$salasana = "apina";
$tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");
echo  "apina  ".$tiiviste."</br>";

$salasana = "haha";
$tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");
echo  "haha  ".$tiiviste."</br>";

$salasana = "roskienkeraaja";
$tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");
echo  "roskienkeraaja  ".$tiiviste."</br>";

?>
