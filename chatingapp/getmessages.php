<?php
if(isset($_GET['folder'])) {
    $folder = preg_replace("/[^a-zA-Z0-9_-]/", "_", $_GET['folder']);

    if(is_dir($folder)) {
        $files = scandir($folder, SCANDIR_SORT_ASCENDING);
        foreach($files as $file) {
            if($file === '.' || $file === '..') continue;

            $data = file($folder . "/" . $file, FILE_IGNORE_NEW_LINES);
            if(count($data) >= 3) {
                $name = htmlspecialchars($data[0]);
                $message = htmlspecialchars($data[1]);
                $time = htmlspecialchars($data[2]);
                echo "<div class='message'>
                        <span class='name'>$name:</span> $message
                        <span class='time'>$time</span>
                      </div>";
            }
        }
    } else {
        echo "<div style='color:#888'>No messages yet.</div>";
    }
}
?>