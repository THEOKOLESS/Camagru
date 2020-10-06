<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/bootstrap.min.css">
        <link rel="stylesheet" href="public/camagru.css">
        <link rel="stylesheet" href="public/menu.css">
    </head>   
    <body>
    <header>
        <?php include("view/menu.php"); ?>
    </header>
    <div class="container">
        <?= $content ?>
    </div>
    <footer></footer>
    </body>
</html>
