<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
$user = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clicks   = $row['clicks'] ?? 0;
$rebirths = $row['rebirths'] ?? 0;
$farmerzy = $row['farmerzy'] ?? 0;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wiejska Farma</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="gra" style="background-image: url('farma.jpg'); background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <h1>🌾 Witaj, <?php echo htmlspecialchars($user); ?>! 🌾</h1>
        <div class="stats">
            <p>🐔 Kliknięcia: <span id="clicks"><?php echo $clicks; ?></span></p>
            <p>👴 Rebirthy: <span id="rebirths"><?php echo $rebirths; ?></span></p>
            <p>🚜 Farmerzy: <span id="farmerzy"><?php echo $farmerzy; ?></span></p>
            <?php 
            if ($farmerzy > 0) {
                $farmersLevel = floor($farmerzy / 5) + 1;
                echo "<p>🌱 Zasiej – lvl " . $farmersLevel . "</p>";
            }
            ?>
        </div>
        <div class="buttons">
            <button onclick="clickButton()">🐄 Kliknij mnie!</button>
            <button onclick="buyFarmer()">🌽 Kup Farmerów</button>
            <button onclick="doRebirth()">🌀 Rebirth</button>
            <button onclick="logout()">🚪 Wyloguj</button>
        </div>
        <div class="leaderboard">
            <h2>🏆 Najlepsi Rebirtowie</h2>
            <?php
            $stmt = $conn->prepare("SELECT username, rebirths FROM users WHERE rebirths > 0 ORDER BY rebirths DESC LIMIT 10");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<ol>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($row['username']) . ": " . $row['rebirths'] . " rebirthów</li>";
                }
                echo "</ol>";
            } else {
                echo "<p>Brak danych do wyświetlenia.</p>";
            }
            ?>
        </div>
    </div>
    <script>
        function clickButton() {
            fetch('click.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('clicks').innerText = data;
                })
                .catch(error => {
                    console.error('Błąd:', error);
                    alert('Wystąpił problem, spróbuj ponownie.');
                });
        }
        function buyFarmer() {
            fetch('buy_farmer.php')
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                })
                .catch(error => {
                    console.error('Błąd:', error);
                    alert('Wystąpił problem, spróbuj ponownie.');
                });
        }
        function doRebirth() {
            fetch('rebirth.php')
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                })
                .catch(error => {
                    console.error('Błąd:', error);
                    alert('Wystąpił problem, spróbuj ponownie.');
                });
        }
        function logout() {
            window.location.href = 'logout.php';
        }
    </script>
</body>
</html>
