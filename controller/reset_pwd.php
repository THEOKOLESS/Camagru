
<?php
require('public/tools.php');
require('model/change_pwd.php');

function check_form($db, $request, $email, $errors, &$reset){
    if(isset($_POST["action"]) &&
    ($_POST["action"]=="update")){
       
        $pwd = init_value('pass1');
        $pwd_bis = init_value('pass2');
        // $email = init_value('email');
        check_password($pwd, $errors, $pwd_bis);
        
        if (count($errors) === 0){
            $reset = !$reset;
            recover_pwd($db, $pwd, $email);
        }
    
    }
    return $errors;
}


function start_form($db, $request, &$reset, $errors){
    if (isset($_GET["cle"]) && isset($_GET["email"]) && isset($_GET["action"]) 
    && ($_GET["action"]=="reset")){
        $cle = $_GET["cle"];
        
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");
        $reponse = $db->query("SELECT * FROM password_reset_temp WHERE `cle`='".$cle."' and `email`='".$email."';");
        $res = $reponse->fetch();
        if(!$res){
            $errors[] = 'bad';
            }
        else{
                $expDate = $res['expDate']; 
                if ($expDate >= $curDate){
                    $errors = check_form($db, $request, $email, $errors, $reset);
                }else{
                    $errors[] = 'exp';
                }
            }
           
        } 
        else{ 
            $errors[] = 'bad';
        }
        return $errors;
    }
  

    $reset = false;
    $errors = array();
    $errors = start_form($db, $request, $reset, $errors);


if ($reset == false)
{
    switch($errors[0]){
        case 'bad':
            require('view/Reset_Mdp/bad_link.php');
        break;
        case 'exp':
            require('view/Reset_Mdp/expired_link.php');
        break;
        default:
            require('view/Reset_Mdp/reset_form_view.php');
    }
}
else if ($reset == true && count($errors) === 0){
    require('view/Reset_Mdp/pwd_reset.php');
}





?>


