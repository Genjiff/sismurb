<?php
    $id = 0;

    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $id = $_GET["id"];
    }

    if ($id) {
        include_once("util/connect.php");

        $stmt = $conn->prepare("DELETE FROM consulta WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    header("Location: index.php?page=consultas");
?>
