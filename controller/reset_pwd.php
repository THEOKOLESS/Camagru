
<?php
require('public/tools.php');
require('model/change_pwd.php');

function check_form($db, $request, $email){
    $errors = array();
    if(isset($_POST["action"]) &&
    ($_POST["action"]=="update")){
       
        $pwd = init_value('pass1');
        $pwd_bis = init_value('pass2');
        // $email = init_value('email');
        check_password($pwd, $errors, $pwd_bis);
        
        if (count($errors) === 0){
            recover_pwd($db, $pwd, $email);
                   // header('Location: http://localhost/pwd_reset');
            // include('view/message.php');
        }
  
        // else{   
        //     return $errors ;
        //     // echo'<div id=shlag>'  ;   
        //     // include('view/message.php');
        //     // write_form($email);
        //     // echo'</div>'  ;  
        // }
    
    }
    return $errors;
}


function start_form($db, $request){
    if (isset($_GET["cle"]) && isset($_GET["email"]) && isset($_GET["action"]) 
    && ($_GET["action"]=="reset")){
        $cle = $_GET["cle"];
        $errors = array();
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");
        $reponse = $db->query("SELECT * FROM password_reset_temp WHERE `cle`='".$cle."' and `email`='".$email."';");
        $res = $reponse->fetch();
        if(!$res){
            header('Location: http://localhost/bad_link');
            }else{
                $expDate = $res['expDate']; 
                if ($expDate >= $curDate){
              
                    $errors = check_form($db, $request, $email);
                }else{
                    header('Location: http://localhost/expired_link');
                }
            }
           
        } 
        else{ 
            $errors[] = 'something went wrong..';
        }
      
        
        // check_form($db, $request);
        return $errors;
    }
  


    $errors = start_form($db, $request);

?>
<?php require('view/Reset_Mdp/reset_form_view.php')?>


