<?php
    include_once("instance/config.php");

    $conn = new mysqli($host, $user, $password, "sismurb");
    // Check connection
    if ($conn->connect_error) {
        die("Falha de conexão: " . $conn->connect_error);
    }
?>
