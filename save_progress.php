<?php
session_start();
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$username = $_SESSION['username'];
$money = (int)$data['money'];
$clickValue = (int)$data['clickValue'];
$farmlandFactor = (float)$data['farmlandFactor'];
$rebirthTokens = (int)$data['rebirthTokens'];
$rebirthMultiplier = (float)$data['rebirthMultiplier'];
$stmt = $conn->prepare("REPLACE INTO players (username, money, clickValue, farmlandFactor, rebirthTokens, rebirthMultiplier) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiidi", $username, $money, $clickValue, $farmlandFactor, $rebirthTokens, $rebirthMultiplier);
$stmt->execute();
$stmt->close();
$conn->close();
?>
