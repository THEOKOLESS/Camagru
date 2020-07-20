<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Cache-control" content="no-cache">
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        <h1>Camagru</h1>
4
<?php
require 'config/setup.php';

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

?>
        <!-- register -->
         <h1>Register</h1>
         <a href="view/register.php">inscription</a>
<!-- <div class="container">
    <form action="register.php" method="POST" class="form-horizontal">
        <fieldset>

 <?php
// include 'register.php'

 //display_message($errors);
 ?>
 <div class="control-group">
     <label for="username" class="control-label">Name:</label>
        <div class="controls">
            <input type="text"
                name="username"
                id="username"
                value="
                <?php// display_value('username')?>"
                class="input-xlarge"
                placeholder="Name"/>
        </div>
 </div>

 <div class="control-group">
 <div class="controls">
 <input type="submit" name="submit" value="Send" class="btn">
 <input type="reset" name="reset" value="Reset" class="btn">
 </div>
 </div>
 </fieldset>
 </form>
</div> -->
    <!-- <form action="register.php" method="post">
             <label for="username">Username</label>
             <input type="text" id="username" name="username"><br>
             <label for="email">Email</label>
             <input type="text" id="email" name="email"><br>
             <label for="password">Password</label>
             <input type="text" id="password" name="password"><br>
             <input type="submit" name="register" value="Register"></button>
         </form> -->

    </body>
</html>
