<?php
session_start();

// Auth guard
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

require 'db.php';

$msg   = '';
$obsah = null;
$nazev = null;

// Upload souboru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['soubor'])) {
    $f = $_FILES['soubor'];
    if ($f['error'] === 0 && strtolower(substr($f['name'], -4)) === '.txt') {
        $obsah = file_get_contents($f['tmp_name']);
        $nazev = basename($f['name']);
    } else {
        $msg = 'Vyber platný .txt soubor.';
    }
}

// Uložit zpět
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['akce']) && $_POST['akce'] === 'ulozit') {
    $nazev = basename($_POST['nazev'] ?? 'soubor.txt');
    $obsah_save = $_POST['obsah'] ?? '';
    header('Content-Type: text/plain; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $nazev . '"');
    header('Content-Length: ' . strlen($obsah_save));
    echo $obsah_save;
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<meta charset="UTF-8">
<title>txt editor</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="top">
  <h1>txt editor</h1>
  <?php if ($obsah !== null): ?>
    <form method="POST" enctype="multipart/form-data">
      <label style="padding:.3rem .7rem;font-size:12px;background:#f0f0f0;color:#444;border:1px solid #ddd;border-radius:4px;cursor:pointer">
        jiný soubor
        <input type="file" name="soubor" accept=".txt" onchange="this.form.submit()">
      </label>
    </form>
  <?php endif; ?>
  <span class="user">👤 <?= htmlspecialchars($_SESSION['username']) ?></span>
  <a href="?logout=1" class="logout">odhlásit</a>
</div>

<?php if ($msg): ?>
  <div class="msg"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<?php if ($obsah !== null): ?>

  <form method="POST" class="editor">
    <input type="hidden" name="akce" value="ulozit">
    <input type="hidden" name="nazev" value="<?= htmlspecialchars($nazev) ?>">
    <div class="bar">
      <span><?= htmlspecialchars($nazev) ?></span>
      <button type="button" class="del" onclick="if(confirm('Zavřít soubor?')){location.href=location.pathname}">zavřít</button>
      <button type="submit" class="save">uložit</button>
    </div>
    <textarea name="obsah" autofocus><?= htmlspecialchars($obsah) ?></textarea>
  </form>

<?php else: ?>

  <div class="upload-zone">
    <div class="upload-box">
      <form method="POST" enctype="multipart/form-data">
        <label>
          Vybrat .txt soubor
          <input type="file" name="soubor" accept=".txt" onchange="this.form.submit()">
        </label>
      </form>
    </div>
  </div>

<?php endif; ?>

</body>
</html>
