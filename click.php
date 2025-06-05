<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(403);
    exit("Brak autoryzacji");
}
include 'db.php';
$user = $_SESSION['username'];
$stmt = $conn->prepare("UPDATE users SET clicks = clicks + 1 WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt = $conn->prepare("SELECT clicks FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($clicks);
$stmt->fetch();
echo $clicks;
?>
