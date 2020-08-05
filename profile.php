<?php
session_start();
require 'config/setup.php';
$db = dbConnect();
?>
<head>
    <meta charset="utf-8" />
    <!-- <meta http-equiv="Cache-control" content="no-cache"> -->
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <?php include("menu.php");
    if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
    ?>
    <div class="center">
         <h2>Profil de <?php echo $username; ?></h2>
         <br /><br />
         Mail : <?php echo $email; ?>
         <br />
         <br />
         <a href="edit_profil.php">Editer mon profil</a>
         <a href="deco.php">Se déconnecter</a>
      </div>
<?php
    }
?>  

</body>
