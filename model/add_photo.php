<?php
    function add_photo($db, $id, $filename){
        $req = $db->prepare('INSERT INTO photo(pic_name, id_user) VALUES(:filename, :id)');
        $req->execute(array(
        'filename' => $filename,
        'id' => $id
        ));
    }

    function prep_photo($db){
        if (isset($_POST['submit'])){
            

            $id = $_SESSION['id'];
            $filename = $_SESSION['username'] . "_" . md5(microtime(TRUE)*1000).".jpeg";
            $photo = $_POST['photo_test'];
            $cat = $_POST['selected_image'];
            
            $bg = imagecreatefrompng($photo);
            $img = imagecreatefrompng($cat);

            imagecopy($bg, $img, 0, 0, 50, 100, imagesx($img), imagesy($bg));
            $fb_jpeg = fopen("../upload/image/$filename",'a+');
           
            imagejpeg($bg, $fb_jpeg);


            imagedestroy($bg);
            imagedestroy($img);
            add_photo($db, $id, $filename);
        }
    }