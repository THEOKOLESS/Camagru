<?php 
	if(isset($_POST['submit'])){
		if(count($errors) === 0 && $request == '/register'){
		?>
			<div class="alert alert-success">
				<p>Vous allez recevoir un mail de confirmation a l'adresse indique</p>
			</div>
		<?php
        }else if(count($errors) === 0 && $request == '/enter_email'){
        ?>
			<div class="alert alert-success">
				<p>Vous allez recevoir un mail de reinitialisation a l'adresse indique</p>
			</div>
		<?php
		}else if(count($errors) === 0 && $request == '/connexion'){
			header('Location: http://localhost:8080/');
        	exit();
		}
		else if(count($errors) === 0 && $request == '/reset_pwd'){
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
        else{
		?>
			<div class="alert alert-block alert-error fade in">
				<?php
					foreach ($errors as $error) {
						echo "<li>$error</li>";
					}
				?>
			</div>
				<?php
        }
    }