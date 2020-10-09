<?php

function add_photo($db, $id, $filename){
    $req = $db->prepare('INSERT INTO photo(file_pic_path, id_user) VALUES(:filename, :id)');
    $req->execute(array(
    'filename' => $filename,
    'id' => $id
    ));
  }

 if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
      require('view/Montage/montage_view.php');


      if (isset($_POST['submit'])){
        $id = $_SESSION['id'];
        $filename = $_SESSION['username'] . "_" . md5(microtime(TRUE)*1000);
        $photo = $_POST['photo_test'];
        $fp = fopen("upload/image/$filename.txt",'a+');
        $fwrite = fwrite($fp, $photo);
        add_photo($db, $id, $filename);

      }
    }
    else{
      header('Location: http://localhost:8080/connexion');
      exit();
   }


