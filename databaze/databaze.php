<?php
$Dsn = "mysql:host=localhost;dbname=fucik;charset=utf8";
$Username = "admin";
$Password = "admin";
 
try {
  $db = new PDO($Dsn, $Username, $Password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
 