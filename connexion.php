<?php
require 'config/setup.php';
$errors = array();
$username = '';
$db = dbConnect();
$pwd = '';
$id = 0;


function check_log()
{
  global $errors, $username, $pwd, $db;
  
  $username = $_POST['username'];
  $pwd = $_POST['pwd'];
  if ($pwd == '' || $username == ''){
    $errors[] = 'Veuiller renseigner votre nom d\'utilisateur ET votre mot de passe';
    return false;
  }
  $stmt = $db->prepare("SELECT id, pwd, actif FROM users WHERE username LIKE :username");
  $stmt->execute(array(
    'username' => $username));
  $res = $stmt->fetch();
  $id = $res['id'];
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


function display_message($errors){
  if(count($errors)){
 ?>
    <div class="alert alert-block alert-error">
      <?php
        foreach ($errors as $error) {
          echo "<li>$error</li>";
        }
      ?>
    </div>
  <?php
  }
}

function connect_form(){
  global $username, $id; 
  if(isset($_POST['submit']))
  {
      if(check_log()){
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        header('Location: http://localhost:8080/index.php');
        // exit();
      }
  }
}

connect_form();
?>


<head>
  <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
	<link rel="stylesheet" href="connexion.css">
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
    <?php
				if(isset($_POST['submit'])){
					display_message($errors);
				}
		?>
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
if (isset($_SESSION['id']) AND isset($_SESSION['username']))
{
    echo 'Bonjour ' . $_SESSION['username'];
}
?>
    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
</body>