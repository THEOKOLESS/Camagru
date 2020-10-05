<?php
 if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
    require('view/Montage/montage_view.php');
 }else{
    header('Location: http://localhost:8080/connexion');
    exit();
}


