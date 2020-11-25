<?php

require 'config/setup.php';

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'upload/'; // upload directory
if($_FILES['image'])
{
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];        
    $filename = $_FILES['image']['name'];


    $fileTmpName = $_FILES['image']['tmp_name'];

    $FileExt = explode('.', $filename);
    $fileactualext = strtolower(end($FileExt));
    $newname = uniqid('', true).".".$fileactualext;

    $filedestination = 'upload/image/'.$newname;
    
    move_uploaded_file($fileTmpName, $filedestination );
    
    
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
echo ($fileactualext);
?>