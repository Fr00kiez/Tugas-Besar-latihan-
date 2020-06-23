<?php
include "functions/database.php";
session_start();
if (isset($_SESSION['login_user'])) {
    $user_check = $_SESSION['login_user'];

    $admin = $conn->prepare('SELECT * FROM pelanggan WHERE email = :email');
    $admin->execute(array( ':email' => $user_check ));
    $row = $admin->fetch(PDO::FETCH_ASSOC);

    $login_session=$row['email'];
    $idpelanggan = $row['idpelanggan'];
}