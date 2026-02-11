<?php

    $slovo = $_GET["slovo"];
    $cislo = $_GET["cislo"];

    echo"<ol>";
    for ($i = 0; $i < $cislo; $i++) {
        echo "<li>$$slovo</li>";
    }
    echo "</ol>";

?>