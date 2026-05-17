<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

echo "Bạn đang mượn sách ID: " . $id;
?>