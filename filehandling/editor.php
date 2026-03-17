<?php
$msg = '';
$obsah = null;
$nazev = null;
$tmp = null;

// Upload souboru
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

// Uložit zpět
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
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font: 14px/1.6 monospace; background: #f9f9f7; color: #222; height: 100vh; display: flex; flex-direction: column; }

  .top { padding: 1rem 1.2rem; border-bottom: 1px solid #e0e0e0; background: #fff; display: flex; align-items: center; gap: 1rem; }
  .top h1 { font-size: 14px; font-weight: 600; color: #555; }

  /* Upload zona */
  .upload-zone { flex: 1; display: flex; align-items: center; justify-content: center; }
  .upload-box { text-align: center; }
  .upload-box label {
    display: inline-block;
    padding: .7rem 1.4rem;
    background: #222;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    font-size: 13px;
  }
  .upload-box label:hover { background: #444; }
  .upload-box p { margin-top: .6rem; font-size: 12px; color: #aaa; }
  input[type=file] { display: none; }

  /* Editor */
  .editor { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
  .bar { padding: .6rem 1rem; border-bottom: 1px solid #e0e0e0; background: #fff; display: flex; align-items: center; gap: .5rem; }
  .bar span { font-size: 13px; color: #666; flex: 1; }
  textarea { flex: 1; border: none; outline: none; resize: none; font: 14px/1.7 monospace; padding: 1.2rem 1.4rem; background: #f9f9f7; color: #222; }

  button { font: 13px monospace; padding: .35rem .85rem; border-radius: 4px; cursor: pointer; border: 1px solid #ddd; background: #fff; color: #444; }
  button.save { background: #222; color: #fff; border-color: #222; }
  button.del  { color: #c0392b; }

  .msg { padding: .5rem 1rem; font-size: 12px; background: #fff3f3; color: #c0392b; border-bottom: 1px solid #fdd; }
</style>
</head>
<body>

<div class="top">
  <h1>txt editor</h1>
  <?php if ($obsah !== null): ?>
    <form method="POST" enctype="multipart/form-data">
      <label style="padding:.3rem .7rem;font-size:12px;background:#f0f0f0;color:#444;border:1px solid #ddd;border-radius:4px;cursor:pointer">
        ↺ jiný soubor
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
          📂 Vybrat .txt soubor
          <input type="file" name="soubor" accept=".txt" onchange="this.form.submit()">
        </label>
        <p>Vyber soubor ze svého počítače</p>
      </form>
    </div>
  </div>

<?php endif; ?>

</body>
</html>
