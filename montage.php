<?php
 if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
      require('view/Montage/montage_view.php');


      $photo = $_GET['photo_src'];
      echo $photo;
    }
    else{
      header('Location: http://localhost:8080/connexion');
      exit();
   }


