<?php 
  
	if(isset($_POST['submit']) || isset($_POST["action"])){
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
			header('Location: http://localhost/');
        	exit();
		}
		else if (count($errors) === 0 && $request == '/edit_profile'){
			?>
			<div class="alert alert-success">
				<p>Vos modifications ont bien été enregistrée</p>
			</div>
		<?php
		}
		else if(count($errors) === 0 && $request == '/reset_pwd'){
			?>
				<div class="alert alert-success">
					<p>MDP reset avec SUCCES !! </p>
				</div>
				<h2>ENCORE BRAVO</h2>
				<p>tous s'est bien passé :')</p>
				<p><a href="connexion">
				Click maggle</a> pour le tester !</p>
			<?php
		}
		else if($request == '/montage'){
			?>
			<div class="alert alert-success">
				<p>Wow you are so biutiful my butterfly</p>
			</div>
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
	if (isset($_GET['upload'])){
		if($_GET['upload'] == 'ok'){
			?>
			<div class="alert alert-success">
				<p>photo uploaded, it goes it own way now</p>
			</div>
		<?php
		}
		else if($_GET['upload']=='too_big'){
			?>
			<div class="alert alert-block alert-error fade in">
				<?php
						echo "error : file too big :(";
				?>
			</div>
				<?php
		}
		else if($_GET['upload']=='err'){
			?>
			<div class="alert alert-block alert-error fade in">
				<?php
						echo "error while uploading file";
				?>
			</div>
				<?php
		}
		else if($_GET['upload']=='err_ext'){
			?>
			<div class="alert alert-block alert-error fade in">
				<?php
						echo "error : put a file and a good one ;)";
				?>
			</div>
				<?php
		}
	}

	// echo $_GET['upload'];