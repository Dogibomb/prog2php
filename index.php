<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- <form action="welcome.php" method="get">
    radky:<input type="number" name="radky"><br>
    sloupce:<input type="number" name="sloupce"><br>
    <input type="submit">
    </form>

    <form action="welcome2.php" method="get">
    slovo:<input type="text" name="slovo"><br>
    kolikrat:<input type="number" name="cislo"><br>
    <input type="submit">
    </form> -->

<br><br><br>

<form action="list.php" method="post">
    <label for="checkbox">Checkbox:</label>
    <input type="checkbox" name="checkbox"><br>

    <label for="color">Color:</label>
    <input type="color" name="color"><br>

    <label for="email">Email:</label>
    <input type="email" name="email" placeholder="Enter email"><br>

    <label for="number">Number:</label>
    <input type="number" name="number" min="1" max="10"><br>

    <label for="date">Date:</label>
    <input type="date" name="date"><br>

    <label for="time">Time:</label>
    <input type="time" name="time"><br>

    <label for="file">File:</label>
    <input type="file" name="file"><br>

    <input type="color" name="color2"><br>
    <input type="range" name="range" min="0" max="2000"><br>
    <input type="search" name="search" placeholder="Search"><br>
    <input type="url" name="url" placeholder="Enter URL"><br>
    <input type="tel" name="phone" placeholder="Enter phone number"><br>

    <input type="hidden" name="hidden"><br>

    <input type="month" name="month"><br>
    <input type="week" name="week"><br>

    <input type="submit"><br>
</form>



</body>
</html>
