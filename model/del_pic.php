<?php 
session_start();
require '../config/setup.php';

if (isset($_POST['pic'])){
    $user_id = $_SESSION['id']; 
    $pic_id = $_POST['pic'];
    $sql = "DELETE FROM photo WHERE id like ".$pic_id." AND id_user like " .$user_id." ;";
    $array = ['id' => $user_id, 'pic' => $pic, 'pic', 'sql' => $sql];
    $req = $db->prepare("DELETE FROM photo WHERE id like ".$pic_id." AND id_user like " .$user_id." ;");
    $req->execute();

    echo json_encode($array);
}