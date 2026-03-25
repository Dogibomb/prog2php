<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$email || !$password) {
        $msg = 'Vyplň všechna pole.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Neplatný e-mail.';
    } elseif (strlen($password) < 6) {
        $msg = 'Heslo musí mít alespoň 6 znaků.';
    } else {
        // Check duplicate
        $stmt = $db->prepare("SELECT ID FROM users WHERE Username = ? OR Email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $msg = 'Username nebo e-mail již existuje.';
        } else {
          $stmt = $db->prepare("INSERT INTO users (Username, Password, Email) VALUES (?, ?, ?)");
          $stmt->execute([$username, $password, $email]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<meta charset="UTF-8">
<title>Registrace</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="box">
  <h1>Registrace</h1>
  <form method="POST">
    <label>Username</label>
    <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" autofocus>
    <label>E-mail</label>
    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <label>Heslo</label>
    <input type="password" name="password">
    <button type="submit">Registrovat</button>
  </form>
  <?php if ($msg): ?><div class="msg"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
  <div class="link">Už máš účet? <a href="login.php">Přihlásit se</a></div>
</div>
</body>
</html>
