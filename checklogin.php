<?php
       require_once 'DB.php';
       session_start();
?>
<!DOCTYPE html>

<head>
   <title>checklogin</title>
   <meta charset="utf-8">
</head>
<?php

        $email = $_POST["email"];
        $salasana = $_POST["salasana"];

	// Haetaan henkiloID
        $yhteys = db::getDB();
        $sql = "SELECT henkiloid FROM henkilo WHERE email = ? AND salasana = ?";
       	$kysely = $yhteys->prepare($sql);
        $kysely->execute(array($email, $salasana));
        $taulu = $kysely->fetch();

	// Haetaan henkilön rooli
	$roolisql = "SELECT rooli FROM henkilo WHERE henkiloid = ?";
	$roolik = $yhteys->prepare($roolisql);
	$roolik->execute(array($taulu["henkiloid"]));
	$rooli = $roolik->fetch();

	// Ohjaus oikeaan paikkaan
        if ($rooli["rooli"] == "admin") {
               $_SESSION["ihminen"] = $taulu["henkiloid"];
               header("Location: admin.php?admin=".$taulu["henkiloid"]); die();
        }

        if ($rooli["rooli"] == "opettaja") {
               $_SESSION["ihminen"] = $taulu["henkiloid"];
               header("Location: opettaja.php?opettaja=".$taulu["henkiloid"]); die();
        }

        if ($rooli["rooli"] == "vastuuhenkilö") {
               $_SESSION["ihminen"] = $taulu["henkiloid"];
               header("Location: vastuuhenkilö.php?vastuuhenkilö=".$taulu["henkiloid"]); die();
        }

        header("Location: index.php?m=kurjuus");
?>

