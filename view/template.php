<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="menu.css">
    </head>
        
    <body>
        <?php include("menu.php");

        ?>
        <?= $content ?>
    </body>
</html>
