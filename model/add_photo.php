<?php
    function add_photo($db, $id, $filename){
        $req = $db->prepare('INSERT INTO photo(file_pic_path, id_user) VALUES(:filename, :id)');
        $req->execute(array(
        'filename' => $filename,
        'id' => $id
        ));
    }

    function prep_photo($db){
        if (isset($_POST['submit'])){
            

            $id = $_SESSION['id'];
            $filename = $_SESSION['username'] . "_" . md5(microtime(TRUE)*1000);
            $photo = $_POST['photo_test'];
            $cat = 'public/img/megalo_test.png';
            
            $bg = imagecreatefrompng($photo);
            $img = imagecreatefrompng($cat);
            imagecopy($bg, $img, 50, 0, 150, 0, imagesx($img), imagesy($bg));
            $fb_jpeg = fopen("upload/image/$filename.jpeg",'a+');
            echo imagesx($bg). "   " . imagesy($bg);
            // $fp = fopen("upload/image/$filename.txt",'a+');
            // $fwrite = fwrite($fp, $photo);
            imagejpeg($bg, $fb_jpeg);
            imagedestroy($bg);
            imagedestroy($img);
            add_photo($db, $id, $filename);
        }
    }