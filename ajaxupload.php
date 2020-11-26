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
                // echo $_SESSION['id'];
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
    
    // $img = $_FILES['image']['name'];
    // $tmp = $_FILES['image']['tmp_name'];
    // // get uploaded file's extension
    // $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // // can upload same image using rand function
    // $final_image = rand(1000,1000000).$img;
    // // check's valid format
    // if(in_array($ext, $valid_extensions)) 
    // { 
    //     $path = $path.strtolower($final_image); 
    //     if(move_uploaded_file($tmp,$path)) 
    //     {
    //         echo "<img src='$path' />";
    //         //include database configuration file
    //         include_once 'db.php';
    //         //insert form data in the database
    //         $insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('".$name."','".$email."','".$path."')");
    //         //echo $insert?'ok':'err';
    //     }
    // } 
    // else 
    // {
    //     echo 'invalid';
    // }
}
// $res = "";
// foreach($_FILES as $result) {
//      $res .= $result . '<br>';
// }

// echo $res;

// echo $_POST['name'];
?>