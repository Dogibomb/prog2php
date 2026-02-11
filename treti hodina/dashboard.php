<?php
session_start();
 
echo "dostal jsem: " .$_POST ["uname"]. "<br>";
echo "dostal jsem: " .$_POST ["psw"];
 
 
if ($_POST["uname"] == "admin" && $_POST["psw"] == "admin")
{
    $_SESSION["uname"] = $_POST["uname"];
    $_SESSION["psw"] = $_POST["psw"];
 
}
 
 
if (isset ($_SESSION["uname"]))
{
    $pass = $_SESSION["psw"];
    $user = $_SESSION["uname"];
 
    echo "<br><br>uživatel $user a heslo $pass";
 
 
 
    echo '
        <form action="" method="get">
            <input type="submit" name = "logout" value="Odhlásit se">
        </form>
    ';
 
    echo isset($_GET["logout"]) ? "odhlasit": "neodhlasit";
    if (isset($_GET["logout"])){
        session_unset();
        session_destroy();
        header("location: http://localhost/prog2php/");
    }
}
else
{
    echo "<br><br>UŽIVATEL NENÍ AUTORIZOVANÝ";
   
}
 
 
?>