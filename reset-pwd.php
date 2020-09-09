
<head>
    <meta charset="utf-8" />
    <!-- <meta http-equiv="Cache-control" content="no-cache"> -->
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<?php include("menu.php");?>  

<?php

require 'config/setup.php';
$db = dbConnect();
$errors = array();
$pwd = '';
$pwd_bis = '';

function checkPassword($pwd, &$errors) {
    $errors_init = $errors;

    if (strlen($pwd) < 8) {
        $errors[] = "Votre Mot de passe doit contenir au moins 8 characteres!";
    }
    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one letter!";
    }
    if (!preg_match("#[a-z]+#", $pwd)) {
        $errors[] = "Password must include at least one lowercase letter!";
    }
    if (!preg_match("#[A-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one uppercase letter!";
    }
    return ($errors == $errors_init);
}

function write_form(){
    global $email;
        ?>
        <br />
        <form method="post" action="" name="update">
        <input type="hidden" name="action" value="update" />
        <br /><br />
        <label><strong>Enter New Password:</strong></label><br />
        <input type="password" name="pass1" maxlength="45" />
        <br /><br />
        <label><strong>Re-Enter New Password:</strong></label><br />
        <input type="password" name="pass2" maxlength="45" />
        <br /><br />
        <input type="hidden" name="email" value="<?php echo $email;?>"/>
        <input type="submit" value="submit" />
        </form>
    <?php
}

function start_form(){
    global $errors, $db, $email, $res, $curDate;
   
    if (isset($_GET["cle"]) && isset($_GET["email"]) && isset($_GET["action"]) 
    && ($_GET["action"]=="reset") && !isset($_POST["action"])){
        $cle = $_GET["cle"];
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");
        $reponse = $db->query("SELECT * FROM password_reset_temp WHERE `cle`='".$cle."' and `email`='".$email."';");
        $res = $reponse->fetch();
        if(!$res){
        ?><h2>Invalid Link</h2>
            <p>le liens n'est pas bon</p>
            <p><a href="enter_email.php">
            Click here</a> to reset password.</p><?php
        }else{
                $expDate = $res['expDate']; 
                if ($expDate >= $curDate){
                    write_form();
                }else{
                    ?> <h2>Link Expired</h2>
                    <p>The link is expired. You are trying to use the expired link which 
                    as valid only 24 hours (1 days after request).<br /><br /></p>" <?php
                }
            }
        } // end of check
    if(isset($_POST["email"]) && isset($_POST["action"]) &&
        ($_POST["action"]=="update")){
           $error="";
           $pwd = $_POST['pass1'];
           $pwd_bis = $_POST['pass2'];
           $email = $_POST["email"];
           checkPassword($pwd, $errors);
           if ($pwd!=$pwd_bis){
               $errors[] = "<p>Password do not match, both password should be same.<br /><br /></p>";
            }
            if(count($errors)){
                ?>
                <div class="alert alert-block alert-error fade in">
                    <?php
                        foreach ($errors as $error) {
                            echo "<li>$error</li>";
                        }
                    ?>
                </div>
                <?php
                   write_form();
                   }
            else{
                    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $req = $db->prepare("UPDATE `users` SET `pwd` = '".$pwd."' WHERE `email`='".$email."';");
                    $req->execute();
                    $req = $db->prepare("DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
                    $req->execute();
                    ?>
                        <div class="alert alert-success">
                            <p>MDP reset avec SUCCES !! </p>
                        </div>
                        <h2>ENCORE BRAVO</h2>
                        <p>tous s'est bien passé :')</p>
                        <p><a href="connexion.php">
                        Click maggle</a> pour le tester !</p>
                    <?php
                }
        }
  
}

start_form();

?>



