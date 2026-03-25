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
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $msg = 'Vyplň všechna pole.';
    } else {
        $stmt = $db->prepare("SELECT ID, Password FROM users WHERE Username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['Password']) {
            $_SESSION['user_id']  = $user['ID'];
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        } else {
            $msg = 'Špatné jméno nebo heslo.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<meta charset="UTF-8">
<title>Přihlášení</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="box">
  <h1>Přihlášení</h1>
  <form method="POST">
    <label>Username</label>
    <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" autofocus>
    <label>Heslo</label>
    <input type="password" name="password">
    <button type="submit">Přihlásit se</button>
  </form>
  <?php if ($msg): ?><div class="msg"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
  <?php if (isset($_GET['registered'])): ?><div class="ok">Účet vytvořen, můžeš se přihlásit.</div><?php endif; ?>
  <div class="link">Nemáš účet? <a href="register.php">Registrovat se</a></div>
</div>
</body>
</html>
