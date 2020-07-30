<?php session_start();
//include 'header.php'?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- <meta http-equiv="Cache-control" content="no-cache"> -->
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <?php include("menu.php"); ?>
        <h1>Camagru</h1>
2412
<?php

if (isset($_SESSION['id']) AND isset($_SESSION['username']))
{
    echo 'Bonjour ' . $_SESSION['username'];
}?>


</body>
</html>
