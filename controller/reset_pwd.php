
<?php
require('public/tools.php');
require('model/change_pwd.php');

function check_form($db, $request){
    if(isset($_POST["email"]) && isset($_POST["action"]) &&
    ($_POST["action"]=="update")){
        require('view/Reset_Mdp/reset_form_view.php'); //template
        $errors = array();
        $pwd = init_value('pass1');
        $pwd_bis = init_value('pass2');
        $email = init_value('email');
        check_password($pwd, $errors, $pwd_bis);
        if (count($errors) === 0){
            recover_pwd($db, $pwd, $email);
            include('view/message.php');
        }
        else{        
            include('view/message.php');
            write_form($email);
        }
     }
}


function start_form($db, $request){
    if (isset($_GET["cle"]) && isset($_GET["email"]) && isset($_GET["action"]) 
    && ($_GET["action"]=="reset") && !isset($_POST["action"])){
        $cle = $_GET["cle"];
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");
        $reponse = $db->query("SELECT * FROM password_reset_temp WHERE `cle`='".$cle."' and `email`='".$email."';");
        $res = $reponse->fetch();
        if(!$res){
            require_once('view/Reset_Mdp/bad_link.php');
            }else{
                $expDate = $res['expDate']; 
                if ($expDate >= $curDate){
                    require_once('view/Reset_Mdp/reset_form_view.php');
                    write_form($email);
                }else{
                    require_once('view/Reset_Mdp/expired_link.php');
                }
            }
        } // end of check
        check_form($db, $request);
    }
  


start_form($db, $request);

?>



