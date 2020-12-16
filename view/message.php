<?php 
  
	if(isset($_POST['submit']) || isset($_POST["action"])){
		if(count($errors) === 0 && $request == '/register'){
		?>
			<div class="notification is-success is-light">
				<p>You will receive a confirmation mail at your email address</p>
			</div>
		<?php
        }else if(count($errors) === 0 && $request == '/enter_email'){
        ?>
			<div class="notification is-success is-light">
				<p>You will receive a reset-password mail at your email address</p>
			</div>
		<?php
		}else if(count($errors) === 0 && $request == '/connexion'){
			header('Location: http://localhost/');
        	exit();
		}
		else if (count($errors) === 0 && $request == '/edit_profile'){
			?>
			<div class="notification is-success is-light">
				<p>You'r modifications have been recorded</p>
			</div>
		<?php
		}
		else if(count($errors) === 0 && $request == '/reset_pwd'){
			?>
				<div class="notification is-success is-light">
					<p>Passeord reset</p>
				</div>
				<h2 class="title is-2">CONGRATULATION :')</h2>
				<p><a href="connexion">
				Click here !!</a>to test this new awesome password !</p>
			<?php
		}
        else{
		?>
			<div class="notification is-danger is-light">
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
			<div class="notification is-success is-light">
				<p>photo uploaded, it goes it own way now</p>
			</div>
		<?php
		}
		else if($_GET['upload']=='too_big'){
			?>
			<div class="notification is-danger is-light">
				<?php
						echo "error : imagine a file size bigger than 2mega ... ";
				?>
			</div>
				<?php
		}
		else if($_GET['upload']=='err'){
			?>
			<div class="notification is-danger is-light">
				<?php
						echo "error while uploading file";
				?>
			</div>
				<?php
		}
		else if($_GET['upload']=='err_ext'){
			?>
			<div class="notification is-danger is-light">
				<?php
						echo "error : put a file and a good one ;)";
				?>
			</div>
				<?php
		}
	}

	// echo $_GET['upload'];