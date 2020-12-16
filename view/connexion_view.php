<?php $title = 'Connexion - Camagru'; ?>
<?php ob_start(); ?>

  <div class="center">

    <h1 class="title is-2">Log in</h1>

    <!-- Login Form -->
    <?php include("view/message.php");?>
    <form action="connexion" method="POST">
      <input type="text" id="login" name="username" placeholder="login">
      <input type="password" id="password" name="pwd" placeholder="password">
      <input type="submit" name="submit" value="Log in">
    </form>
    <!-- Remind Passowrd -->
    <div>
      <a href="enter_email">Forgot password?</a>
    </div>
  </div>


<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>