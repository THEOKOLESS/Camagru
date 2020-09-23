
<?php
require('public/tools.php');
// function write_form(){
//     global $email;
//         ?>
<!-- //         <br />
//         <form method="post" action="" name="update">
//         <input type="hidden" name="action" value="update" />
//         <br /><br />
//         <label><strong>Enter New Password:</strong></label><br />
//         <input type="password" name="pass1" maxlength="45" />
//         <br /><br />
//         <label><strong>Re-Enter New Password:</strong></label><br />
//         <input type="password" name="pass2" maxlength="45" />
//         <br /><br />
//         <input type="hidden" name="email" value="<?php echo $email;?>"/>
//         <input type="submit" value="submit" />
//         </form> -->
    <?php
// }

function start_form($db){
    if (isset($_GET["cle"]) && isset($_GET["email"]) && isset($_GET["action"]) 
    && ($_GET["action"]=="reset") && !isset($_POST["action"])){
        $cle = $_GET["cle"];
        $errors = array();
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");
        $reponse = $db->query("SELECT * FROM password_reset_temp WHERE `cle`='".$cle."' and `email`='".$email."';");
        $res = $reponse->fetch();
        if(!$res){
            require('view/Reset_Mdp/bad_link.php');
            }else{
                $expDate = $res['expDate']; 
                if ($expDate >= $curDate){
                    // write_form();
                    require('view/Reset_Mdp/reset_form.php');
                }else{
                    require('view/Reset_Mdp/expired_link.php');
                }
            }
    } // end of check
    // if(isset($_POST["email"]) && isset($_POST["action"]) &&
    //     ($_POST["action"]=="update")){
    //        $errors = array();
    //        $pwd = $_POST['pass1'];
    //        $pwd_bis = $_POST['pass2'];
    //        $email = $_POST["email"];
    //        checkPassword($pwd, $errors);
    //        if ($pwd!=$pwd_bis){
    //            $errors[] = "<p>Password do not match, both password should be same.<br /><br /></p>";
    //         }
    //              require('view/Reset_Mdp/reset_form.php');
    //             }
    //         else{
    //                 $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    //                 $req = $db->prepare("UPDATE `users` SET `pwd` = '".$pwd."' WHERE `email`='".$email."';");
    //                 $req->execute();
    //                 $req = $db->prepare("DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
    //                 $req->execute();
    //             }
      }
  


start_form($db);

?>



