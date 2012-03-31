'<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>checklogin</title>
   <meta charset="utf-8">
</head>
     <body>
        <?php

        $email = $_POST['email'];
        $salasana = $_POST['salasana'];

        $yhteys = db::getDB();
        //$sql = 'SELECT * FROM henkilo WHERE email='.$email.' and salasana = '.$salasana;
        $sql = 'SELECT * FROM henkilo WHERE email='."joeniemi@cs.helsinki.fi".' and salasana = '."apina";
	$kysely = $yhteys->prepare($sql);
        $kysely->execute();

//        $testi = pg_query($sql);
        $taulu = $kysely->fetch();
       //  if (!$testi) {
        if (count($taulu) == 1) {
            echo count($taulu);
            //echo $email;
            //echo $salasana;
            //echo $testi;
            echo $taulu;
            //header("location:login_success.php");
	    //header('Location: http://www.example.com');
        } else {
            echo $sql . " testi " . $taulu . " Wrong Username or Password";
                 }
        ?>
    </body>
