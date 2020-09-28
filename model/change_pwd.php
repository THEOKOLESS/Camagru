<?php
function change_pwd($db, $pwd, $email){
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $req = $db->prepare("UPDATE `users` SET `pwd` = '".$pwd."' WHERE `email`='".$email."';");
    $req->execute();
    $req = $db->prepare("DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
    $req->execute();
}