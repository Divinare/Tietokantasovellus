<?php
    require_once 'DB.php';
    session_start();
    unset($_SESSION["luku"]);
?>
<!DOCTYPE html>

<head>
<title>Henkilön Lisäys</title>
<meta charset="utf-8">
</head>

<body>
   <?php
   header("Location: index.php");
   ?>
</body>
