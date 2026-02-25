<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php if(isset($_GET['error']) && isset($_SESSION['errors'])): ?>
        <ul style="color:red;">
            <?php foreach($_SESSION['errors'] as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <?php if(isset($_GET['success'])): ?>
        <p style="color:green;">Registrace proběhla úspěšně!</p>
    <?php endif; ?>

    <form action="../users.php" method="post">
        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required>

          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Email" name="email" required>
      
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>
      
          <button type="submit">Registrovat se</button>

          <span class="psw">Už máš účet? <a href="../login/index.html">Přihlás se</a></span>
        </div>
        <div class="container"></div>
    </form>

</body>
</html>