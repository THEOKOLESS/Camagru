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
            $fp = fopen("upload/image/$filename.txt",'a+');
            $fwrite = fwrite($fp, $photo);
            add_photo($db, $id, $filename);
        }
    }