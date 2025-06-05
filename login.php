<?php
session_start();
include 'db.php';
if (isset($_SESSION['username'])) {
    header("Location: gra.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: gra.php");
            exit();
        } else {
            $error = "❌ Błędne hasło!";
        }
    } else {
        $error = "❌ Użytkownik nie istnieje!";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="start" style="background-image: url('zdjecie.png'); background-size: cover;">
    <div class="container">
        <h1>Zaloguj się</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit" class="login-btn">Zaloguj się</button>
        </form>
        <a href="zapomniales.php" class="forgot-password">Zapomniałeś hasła?</a>
        <p class="register-link">Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
    </div>
</body>
</html>
