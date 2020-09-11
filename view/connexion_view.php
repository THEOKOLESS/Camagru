<?php $title = 'Connexion - Camagru'; ?>
<?php ob_start(); ?>
<!-- <head>
	<link rel="stylesheet" href="public/connexion.css">
</head> -->
<body>
 <div class="wrapper"><!-- fadeInDown -->
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active">Se connecter</h2>
    <!-- Icon -->
    <!-- <div class="fadeIn first">
    
    </div> -->

    <!-- Login Form -->
    <?php include("view/message.php");?>
    <form action="connexion" method="POST">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="pwd" placeholder="password">
      <input type="submit" name="submit" class="fadeIn fourth" value="Se connecter">
      <div>
        <input type="checkbox" id="stayconnect" name="stay">
        <label for="stayconnect">Rester connecté</label>
      </div>
    </form>
    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="enter_email.php">Forgot Password?</a>
    </div>
  </div>
</div>
</body>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>