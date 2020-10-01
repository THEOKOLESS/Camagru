<?php
function recover_pwd($db, $pwd, $email){
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $req = $db->prepare("UPDATE `users` SET `pwd` = '".$pwd."' WHERE `email`='".$email."';");
    $req->execute();
    $req = $db->prepare("DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
    $req->execute();
}

function update_pwd_from_id($db, $id, $pwd){
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $req = $db->prepare("UPDATE `users` SET `pwd` = '".$pwd."' WHERE `id`='".$id."';");
    $req->execute();
}