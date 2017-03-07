<?php
    include_once("instance/config.php");

    $connect = mysql_connect($host, $user, $password) or print(mysql_error());
    mysql_select_db("sismurb", $connect) or print(mysql_error());
?>
