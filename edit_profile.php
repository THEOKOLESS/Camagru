
<?php
require('public/tools.php');
require('model/model_tools.php');

function validate_form(&$errors, $username, $email, $pwd, $new_pwd, $new_pwd_bis, $res){

            check_username($errors, $username);
            check_email($errors, $email);
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

function update_bdd($db, $username, $res){
    $res = update_username_from_username($db, $username, $res);
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
            $res = get_user_info_from_username($db, $username);
           
            if (validate_form($errors, $username, $email, $pwd, $new_pwd, $new_pwd_bis, $res))
                update_bdd($db, $username, $res);        
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