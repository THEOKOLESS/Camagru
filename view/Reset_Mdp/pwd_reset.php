<?php 
    $title = 'Reset MDP - Camagru'; 
    ob_start();  ?>
    <div class="center">

    <h1 class="title is-2">RESET PWD</h1>

    <div class="notification is-success is-light">
					<p>Passeord reset</p>
				</div>
				<h2 class="title is-2">CONGRATULATION :')</h2>
				<p><a href="connexion">
				Click here !!</a>to test this new awesome password !</p>
  </div>
        
    <?php $content = ob_get_clean(); ?>
    <?php require('view/template.php');
  ?>