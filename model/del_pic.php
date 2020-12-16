<?php 
session_start();
require '../config/setup.php';

if (isset($_POST['pic'])){
    $user_id = $_SESSION['id']; 
    $pic = $_POST['pic'];
    $sql = "DELETE FROM `photo` WHERE `pic_name`='".$pic."' AND `id_user`='".$user_id."' ;";
    $array = ['id' => $user_id, 'pic' => $pic, 'pic', 'sql' => $sql];
    $req = $db->prepare("DELETE FROM `photo` WHERE `pic_name`='".$pic."' AND `id_user`='".$user_id."' ;");
    $req->execute();

    echo json_encode($array);
}