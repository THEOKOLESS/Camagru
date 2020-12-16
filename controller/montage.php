<?php

 if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
   $errors = array();
      require('view/Montage/montage_view.php');
    }
    else{
      echo '<script type="text/javascript">'; 
      echo 'alert("Please, log in before tying to go here :)");'; 
      echo 'window.location.href = "connexion";';
      echo '</script>';
      exit();
   }


