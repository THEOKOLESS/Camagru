<?php

require('add_photo.php');


 if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
   $errors = array();
      require('view/Montage/montage_view.php');
      prep_photo($db);
    }
    else{
      header('Location: http://localhost/connexion');
      exit();
   }


