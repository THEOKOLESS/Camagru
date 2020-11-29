<?php
session_start();
require 'config/setup.php';
include 'add_photo.php';

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'upload/image/'; // upload directory
if($_FILES['image'])
{
    $size = $_FILES['image']['size'];
    $tmp = $_FILES['image']['tmp_name'];        
    $filename = $_FILES['image']['name'];
    $fileError = $_FILES['image']['error'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $FileExt = explode('.', $filename);
    $fileactualext = strtolower(end($FileExt));

    if(in_array($fileactualext, $valid_extensions)){
        if($fileError === 0){
            if($size < 1000000){
                $newname = uniqid('', true).".".$fileactualext;
                $filedestination = $path.$newname;
                move_uploaded_file($fileTmpName, $filedestination);
                add_photo($db, $_SESSION['id'], $newname);
                header('Location: http://localhost/montage?upload=ok');
            }
            else{
                header('Location: http://localhost/montage?upload=too_big');
            }
        }
        else{
            header('Location: http://localhost/montage?upload=err');
        }
    }
    else{
        header('Location: http://localhost/montage?upload=err_ext');
    }
    
}

?>