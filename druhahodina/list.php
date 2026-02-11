<?php
    echo "Checkbox: " . (isset($_POST['checkbox']) ? "Checked" : "Not checked") . "<br>";
    echo "Color: " . $_POST['color'] . "<br>";
    echo "Email: " . $_POST['email'] . "<br>";
    echo "Number: " . $_POST['number'] . "<br>";
    echo "Date: " . $_POST['date'] . "<br>";
    echo "Time: " . $_POST['time'] . "<br>";
    echo "File: " . $_POST['file'] . "<br>";
    echo "phone: " . $_POST["phone"] . "<br>";
    echo "url: " . $_POST["url"] . "<br>";
    echo "search: " . $_POST["search"] . "<br>";
    echo "range: " . $_POST["range"] . "<br>";
    echo "color2: " . $_POST["color2"] . "<br>";
    echo "Hidden: " . $_POST['hidden'] . "<br>";
    echo "Month: " . $_POST['month'] . "<br>";
    echo "Week: " . $_POST['week'] . "<br>";
?>