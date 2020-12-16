<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
        <link rel="stylesheet" href="public/camagru.css">  
   </head>   
    <body>    
    <?php include("view/menu.php"); ?>  
        <div class="container">
          
            <?= $content ?>
        </div>
        <footer class="footer" >
            <div class="content has-text-centered">
                <p>
                <strong>Camagru</strong> by <a href="https://github.com/THEOKOLESS">tvitoux</a>.
                </p>
            </div>
        </footer>
    </body>
</html>
