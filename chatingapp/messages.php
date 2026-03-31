<!DOCTYPE html>
<html>
<body>

<!-- Formulář pro zadání absolutní cesty ke složce -->
<form method="GET" action="">
    <label for="folder">Zadej cestu ke složce (např. C:\Users\Ty\krsitina):</label><br>
    <input type="text" id="folder" name="folder" placeholder="C:\Users\Ty\krsitina" required style="width:400px;">
    <br><br>
    <button type="submit">Zobrazit zprávy</button>
</form>

<!-- Chat box vpravo -->
<div id="chatBox">
<?php
if(isset($_GET['folder'])) {
    $folder = $_GET['folder'];

    // bezpečnost: nahrazení zpětných lomítek (Windows) a odstranění nebezpečných znaků
    $folder = str_replace("\\", "/", $folder); 
    $folder = preg_replace("/[<>:\"|?*]/", "_", $folder);

    if(is_dir($folder)) {
        $files = scandir($folder, SCANDIR_SORT_ASCENDING); // od nejstarší
        $anyMessage = false;
        foreach($files as $file) {
            if($file === '.' || $file === '..') continue;

            $data = file($folder . "/" . $file, FILE_IGNORE_NEW_LINES);
            if(count($data) >= 2) {
                $name = htmlspecialchars($data[0]);
                $message = htmlspecialchars($data[1]);
                $time = date("Y-m-d H:i:s", filemtime($folder . "/" . $file));
                echo "<div class='message'>
                        <span class='name'>$name:</span> $message
                        <span class='time'>$time</span>
                      </div>";
                $anyMessage = true;
            }
        }
        if(!$anyMessage){
            echo "<div style='color:#888'>Složka je prázdná.</div>";
        }
    } else {
        echo "<div style='color:#888'>Složka '$folder' neexistuje.</div>";
    }
} else {
    echo "<div style='color:#888'>Zadej cestu ke složce pro zobrazení zpráv.</div>";
}
?>
</div>

<a href="index.html">di zptaky</a>

</body>
</html>