<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Cache-control" content="no-cache">
        <title>Camagru</title>
        <link <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <h1>Camagru</h1>
    58
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
       <form action="register.php" method="post">
             <label for="username">Username</label>
             <input type="text" id="username" name="username"><br>
             <label for="email">Email</label>
             <input type="text" id="email" name="email"><br>
             <label for="password">Password</label>
             <input type="text" id="password" name="password"><br>
             <input type="submit" name="register" value="Register"></button>
         </form>

    </body>
</html>
