<?php
session_start();
include "users.php";

if(!isset($_SESSION['uname'])){
    header("Location: login/index.html");
    exit();
}

$isAdmin = $_SESSION['uname'] === 'admin';
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Panel</title>
    <link rel="stylesheet" href="panel.css">
</head>
<body>

<nav>
    <a href="home.php">Home</a>
    <a href="panel.php">Panel</a>
    <a href="profile.php">Profile</a>
    <form action="logout.php" method="post" style="margin-left:auto;">
        <button class="logout" type="submit">Odhlásit se <?= htmlspecialchars($_SESSION['uname']) ?></button>
    </form>
</nav>

<div class="content">
    <p class="welcome">Přihlášen jako: <b><?= htmlspecialchars($_SESSION['uname']) ?></b></p>

    <?php if($isAdmin): ?>
        <h2>Seznam uživatelů</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Created</th>
            </tr>
            <?php foreach(getAll('users') as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['ID']) ?></td>
                <td><?= htmlspecialchars($user['Name']) ?></td>
                <td><?= htmlspecialchars($user['Email']) ?></td>
                <td><?= htmlspecialchars($user['Password']) ?></td>
                <td><?= htmlspecialchars($user['Created']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p class="no-access">Nemáš přístup k tabulce. Pouze admin může vidět uživatele.</p>
    <?php endif; ?>
</div>

</body>
</html>