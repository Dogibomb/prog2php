<?php
include "../databaze/databaze.php";

function get($table, $ID){
    global $db;

    $sql = "SELECT * FROM $table WHERE  = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id'=>$ID]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getAll($table){
    global $db;

    $sql = "SELECT * FROM $table";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

echo getAll('users', 2);

?>