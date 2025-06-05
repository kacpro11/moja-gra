<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(403);
    exit("Brak autoryzacji");
}
include 'db.php';

$user = $_SESSION['username'];

$stmt = $conn->prepare("SELECT clicks, rebirths, rebirthMultiplier FROM users WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($clicks, $currentRebirths, $currentMultiplier);
if (!$stmt->fetch()) {
    $stmt->close();
    exit("Nie znaleziono danych dla użytkownika lub brak danych.");
}
$stmt->close();

$requiredClicks = 50 + ($currentRebirths * 20);

if ($clicks < $requiredClicks) {
    echo "Nie masz wystarczającej liczby kliknięć do rebirthu! Wymagane: " . $requiredClicks . ".";
    exit();
}

$newRebirths = $currentRebirths + 1;
$newMultiplier = $currentMultiplier * 1.25;

$stmt = $conn->prepare("UPDATE users SET clicks = 0, farmerzy = 0, rebirths = ?, rebirthMultiplier = ? WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ids", $newRebirths, $newMultiplier, $user);
$stmt->execute();
$stmt->close();

echo "Rebirth wykonany! Nowy poziom: " . $newRebirths . ". Bonus mnożnika: " . number_format($newMultiplier, 2);
?>
