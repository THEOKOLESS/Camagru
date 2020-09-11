<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/bootstrap.min.css">
    </head>
        
    <body>
    <?php
    //     if ($handle = opendir('.')) {

    // while (false !== ($entry = readdir($handle))) {

    //     if ($entry != "." && $entry != "..") {

    //         echo "$entry\n";
    //     }
    // }

    // closedir($handle);
    // }?>
        <?php include("menu.php"); ?>
        <?= $content ?>
    </body>
</html>
