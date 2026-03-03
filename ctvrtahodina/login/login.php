<?php
session_start();
include "../users.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['uname'] ?? '');
    $psw  = trim($_POST['psw'] ?? '');

    if(empty($name) || empty($psw)){
        header("Location: index.html");
        echo "zadejte jmeno nebo heslo";
        exit();
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE name = :name AND password = :password");
    $stmt->execute(['name' => $name, 'password' => $psw]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['uname'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../panel.php");
        exit();
    } else {
        header("Location: ../login/index.html?error=1");
        exit();
    }
}
?>