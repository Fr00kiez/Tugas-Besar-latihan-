<?php
include"../functions/database.php";

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM berita WHERE idBerita = :id");
    $stmt->bindParam(":id", $_GET['id']);
    $stmt->execute();
}

header("Location: berita.php");