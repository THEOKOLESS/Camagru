<?php
    function check_log($db, &$id, &$errors, &$email, $username, $pwd)
    {
        if ($pwd == '' || $username == ''){
            $errors[] = 'Veuiller renseigner votre nom d\'utilisateur ET votre mot de passe';
            return false;
        }
        $stmt = $db->prepare("SELECT id, pwd, actif, email FROM users WHERE username LIKE :username");
        $stmt->execute(array('username' => $username));
        $res = $stmt->fetch();
        $id = $res['id'];
        $email = $res['email'];

        $isPasswordCorrect = password_verify($pwd, $res['pwd']);
        if(!$res){
            $errors[] = 'Veuiller verifier votre nom d\'utilisateur';
            return false;
        }
        else if (!$isPasswordCorrect)
        {
            $errors[] = 'MDP faux !';
            return false;
        }
        else if (!$res['actif'])
        {
            $errors[] = 'compte pas activé, go check tes mails';
            return false;
        }
            return true;
    }
?>