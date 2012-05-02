<?php

// Uloskirjautuminen
session_start();
unset($_SESSION["ihminen"]);

header("Location: index.php");
?>
