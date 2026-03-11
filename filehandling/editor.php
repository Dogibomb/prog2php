<?php
$msg = '';
$obsah = null;
$nazev = null;
$tmp = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['soubor'])) {
    $f = $_FILES['soubor'];
    if ($f['error'] === 0 && substr($f['name'], -4) === '.txt') {
        $obsah = file_get_contents($f['tmp_name']);
        $nazev = basename($f['name']);
        $tmp   = $f['tmp_name'];
    } else {
        $msg = 'Vyber platný .txt soubor.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['akce']) && $_POST['akce'] === 'ulozit') {
    $nazev = basename($_POST['nazev'] ?? 'soubor.txt');
    $obsah = $_POST['obsah'] ?? '';
    header('Content-Type: text/plain; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $nazev . '"');
    header('Content-Length: ' . strlen($obsah));
    echo $obsah;
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<meta charset="UTF-8">
<title>editor</title>

</head>
<body>

<div class="top">
  <h1>txt editor</h1>
  <?php if ($obsah !== null): ?>
    <form method="POST" enctype="multipart/form-data">
      <label>
         jiný soubor
        <input type="file" name="soubor" accept=".txt" onchange="this.form.submit()">
      </label>
    </form>
  <?php endif; ?>
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
      <button type="submit" class="save">↓ uložit</button>
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
        <p>Vyber soubor ze svého počítače</p>
      </form>
    </div>
  </div>

<?php endif; ?>

</body>
</html>
