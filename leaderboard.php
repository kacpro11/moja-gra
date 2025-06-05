<?php
require 'db.php';
$sql = "SELECT username, money FROM players ORDER BY money DESC LIMIT 10";
$result = $conn->query($sql);
$leaderboard = [];
while ($row = $result->fetch_assoc()) {
    $leaderboard[] = [
        "username" => $row['username'],
        "money" => $row['money']
    ];
}
echo json_encode($leaderboard);
?>
