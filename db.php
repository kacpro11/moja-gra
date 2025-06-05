<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "farma_db";
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("❌ Błąd połączenia: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>
