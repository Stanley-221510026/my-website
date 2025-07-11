<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ujian_mini");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
