

    <?php include("menu.php");
    echo $_SESSION['id'] . $_SESSION['username'] . $_SESSION['email']; 
    if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
        echo "wtf?"; 
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
