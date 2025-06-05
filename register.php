<?php
include 'db.php';
$registered = false;
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $check_user = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_user->bind_param("s", $username);
    $check_user->execute();
    $result = $check_user->get_result();
    if ($result->num_rows > 0) {
        $message = "<p class='error'>❌ Użytkownik o tej nazwie już istnieje!</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, clicks, farmerzy, rebirths, rebirthMultiplier) VALUES (?, ?, 0, 0, 0, 1.0)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $registered = true;
            $message = "<p class='success'>✅ Pomyślnie zarejestrowano!</p>";
            $stmt2 = $conn->prepare("INSERT INTO players (username, money, clickValue, farmlandFactor, rebirthTokens, rebirthMultiplier) VALUES (?, 0, 1, 1.0, 0, 1.0)");
            $stmt2->bind_param("s", $username);
            $stmt2->execute();
            $stmt2->close();
        } else {
            $message = "<p class='error'>❌ Błąd rejestracji!</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="start" style="background-image: url('zdjecie.png'); background-size: cover;">
    <div class="container">
        <h1>ZACZNIJ GRĘ!</h1>
        <h2>Rejestracja</h2>
        <?php echo $message; ?>
        <?php if (!$registered): ?>
        <form method="POST" action="register.php">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit" class="register-btn">Zarejestruj się</button>
        </form>
        <?php endif; ?>
        <?php if ($registered): ?>
            <a href="login.php"><button class="login-btn">Zaloguj się</button></a>
        <?php else: ?>
            <a href="login.php"><button class="login-btn">Zaloguj się</button></a>
        <?php endif; ?>
    </div>
</body>
</html>
