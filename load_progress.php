<?php
session_start();
require 'db.php';
if (!isset($_SESSION['username'])) {
    echo json_encode(["error" => "Brak sesji"]);
    exit();
}
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT money, clickValue, farmlandFactor, rebirthTokens, rebirthMultiplier FROM players WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($money, $clickValue, $farmlandFactor, $rebirthTokens, $rebirthMultiplier);
if ($stmt->fetch()) {
    echo json_encode([
        "money" => $money,
        "clickValue" => $clickValue,
        "farmlandFactor" => $farmlandFactor,
        "rebirthTokens" => $rebirthTokens,
        "rebirthMultiplier" => $rebirthMultiplier
    ]);
} else {
    echo json_encode([
        "money" => 0,
        "clickValue" => 1,
        "farmlandFactor" => 1.0,
        "rebirthTokens" => 0,
        "rebirthMultiplier" => 1.0
    ]);
}
$stmt->close();
$conn->close();
?>
