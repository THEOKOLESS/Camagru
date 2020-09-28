<?php

    function get_user_info_from_username($db, $username){
        $stmt = $db->prepare("SELECT id, pwd, actif, email FROM users WHERE username LIKE :username");
        $stmt->execute(array('username' => $username));
        $res = $stmt->fetch();
        return($res);
    }
  
?>