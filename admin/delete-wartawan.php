<?php
include"../functions/database.php";

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM wartawan WHERE idwartawan = :idwartawan");
    $stmt->bindParam(":idwartawan", $_GET['id']);
    $stmt->execute();
}

header("Location: wartawan.php");