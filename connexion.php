<?php
require 'config/setup.php';
$errors = array();
$username = '';
$db = dbConnect();
$pwd = '';
$id = 0;
$email = '';


function check_log()
{
  global $errors, $username, $pwd, $db, $email, $id;
  
  $username = $_POST['username'];
  $pwd = $_POST['pwd'];
  if ($pwd == '' || $username == ''){
    $errors[] = 'Veuiller renseigner votre nom d\'utilisateur ET votre mot de passe';
    return false;
  }
  $stmt = $db->prepare("SELECT id, pwd, actif, email FROM users WHERE username LIKE :username");
  $stmt->execute(array('username' => $username));
  $res = $stmt->fetch();
  $id = $res['id'];
  $email = $res['email'];
  echo "email ->   ". $email;
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


function connect_form(){
  global $username, $id, $email; 
  if(isset($_POST['submit']))
  {
      if(check_log()){
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header('Location: http://localhost:8080/index.php');
        exit();
      }
  }
}

connect_form();
?>


<head>
	<link rel="stylesheet" href="public/connexion.css">
</head>
<body>
<?php include("menu.php"); ?>
 <div class="wrapper"><!-- fadeInDown -->
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active">Se connecter</h2>
    <!-- Icon -->
    <!-- <div class="fadeIn first">
    
    </div> -->

    <!-- Login Form -->
    <?php include("message.php");?>
    <form action="connexion.php" method="POST">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="pwd" placeholder="password">
      <input type="submit" name="submit" class="fadeIn fourth" value="Se connecter">
      <div>
        <input type="checkbox" id="stayconnect" name="stay">
        <label for="stayconnect">Rester connecté</label>
      </div>
    </form>
    <?php 
?>
    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="enter_email.php">Forgot Password?</a>
    </div>

  </div>
</div>
</body>