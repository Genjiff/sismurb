<?php
    $id = 0;

    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $id = $_GET["id"];
    }

    if ($id) {
        include_once("util/connect.php");

        $stmt = $conn->prepare("SELECT * FROM paciente WHERE id = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        if ($res = $stmt->get_result()) {
            $res = $res->fetch_assoc();
        } else {
            $error = "Id não existente."
        }

        $stmt->close();
        $conn->close();
    }
?>
