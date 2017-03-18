<?php
$id = 0;

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];
}

if (isset($_GET["return_page"]) && $_GET["return_page"] != "") {
    $return_page = $_GET["return_page"];
} else {
    $return_page = "pacientes";
}

if ($id) {
    include_once("util/connect.php");

    $stmt = $conn->prepare("DELETE FROM pessoa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $conn->close();
}

header("Location: index.php?page=$return_page");

?>
