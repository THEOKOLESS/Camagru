
<?php
require('public/tools.php');
require('model/model_tools.php');
require('model/change_pwd.php');

function double_check_pwd(&$errors, $username, $pwd, $new_pwd, $new_pwd_bis, $db){
    $res = get_user_info_from_id($db);
    
    if($pwd != '' || $new_pwd != '' || $new_pwd_bis != ''){
       
        if (!password_verify($pwd, $res['pwd']))          
        {
            $errors[] = 'MDP faux !';
            return false;
        }
        check_password($new_pwd, $errors, $new_pwd_bis);
    }
    if(count($errors)){
        return false;
    }else{
        return true;
    }
}

function validate_form(&$errors, $username, $email, $pwd, $new_pwd, $new_pwd_bis){

    check_username($errors, $username);
    check_email($errors, $email);    
    if(count($errors)){
        return false;
    }else{
        return true;
    }
}

function update_bdd($db, $username, $email, $pwd, $new_pwd, $new_pwd_bis){
        if($pwd != '' && $new_pwd != '' && $new_pwd_bis != '')
        update_pwd_from_id($db, $_SESSION['id'], $new_pwd_bis);
        if(($_SESSION['username'] != $username ))
            update_username_from_username($db, $username);
        if(($_SESSION['email'] != $email ))
            update_email_from_email($db, $email);
       
}

function updated_form(){
    if ($_SESSION['username'] != $_POST['username'] || $_SESSION['email'] != $_POST['email'] 
 || $_POST['pwd'] || $_POST['new_pwd'] || $_POST['new_pwd_bis'])
            return true;
    return false;
}

function start_form($db){
    $errors = array();
    $username = init_value('username');
	$email = init_value('email');
    $pwd = init_value('pwd');
    $new_pwd = init_value('new_pwd');
	$new_pwd_bis = init_value('new_pwd_bis');
    if(isset($_POST['submit']))
    {
        if (updated_form())
        {
            if (validate_form($errors, $username, $email, $pwd, $new_pwd, $new_pwd_bis, $db))
                if (check_bdd($errors, $username, $email, $db)){
                    if(double_check_pwd($errors, $username, $pwd, $new_pwd, $new_pwd_bis, $db))
                        update_bdd($db, $username, $email, $pwd, $new_pwd, $new_pwd_bis);
                }
                        
        }
        else{
            $errors[] = "vous n'avez rien modifié...";
        }
    }
    return $errors;
}

if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $errors = start_form($db);
    require('view/Profile/edit_profile_view.php');
}
	else {
        header("Location: http://localhost:8080/connexion");
     }?>