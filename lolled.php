<?php require_once 'db.php'; ?><!DOCTYPE html>
<html>
    <body>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    Kysymys
                </td>                
            </tr>
        <?php
        $db = db::getDB;

        $query = "SELECT kysymys FROM kysymys";

        $result = pg_query($query);
        if (!$result) {
            echo "Tuli ongelma " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }

        while($myrow = pg_fetch_assoc($result)) {
            printf ("<tr><td>%s</td></tr>", $myrow['id'], htmlspecialchars($myrow['kysymys']));
        }
        ?>
        </table>
    </body>
</html>
