<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(403);
    exit("Brak autoryzacji");
}
include 'db.php';
$user = $_SESSION['username'];
$stmt = $conn->prepare("SELECT clicks, farmerzy FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($clicks, $farmerzy);
$stmt->fetch();
$stmt->close();
$koszt = 10;
if ($clicks >= $koszt) {
    $stmt = $conn->prepare("UPDATE users SET clicks = clicks - ?, farmerzy = farmerzy + 1 WHERE username = ?");
    $stmt->bind_param("is", $koszt, $user);
    $stmt->execute();
    echo "Kupiono farmera!";
} else {
    echo "Nie masz wystarczającej liczby kliknięć!";
}
?>
