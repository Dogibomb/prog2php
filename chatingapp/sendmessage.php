<?php
if(isset($_POST['folder'], $_POST['name'], $_POST['message'])) {
    $folder = preg_replace("/[^a-zA-Z0-9_-]/", "_", $_POST['folder']); // bezpečný název složky
    $name = strip_tags($_POST['name']); // odstraníme HTML
    $message = strip_tags($_POST['message']);

    // vytvoří složku, pokud neexistuje
    if(!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // soubor se jménem timestamp.txt
    $filename = $folder . "/" . time() . ".txt";
    $content = "Name: $name\nMessage: $message\n";

    if(file_put_contents($filename, $content)) {
        echo "Message saved in folder '$folder'.";
    } else {
        echo "Error saving message.";
    }
} else {
    echo "All fields are required!";
}
?>