<?php 
  
	if(isset($_POST['submit']) || isset($_POST["action"])){
		if(count($errors) === 0 ){
			switch($request){
				case '/register':
				?>
					<div class="notification is-success is-light">
						<p>You will receive a confirmation mail at your email address</p>
					</div>
				<?php
				break;
				case '/enter_email':
				?>
					<div class="notification is-success is-light">
						<p>You will receive a reset-password mail at your email address</p>
						
					</div>
				<?php
				 header('Location: http://localhost/');
				 exit();
				case '/connexion':
					 header('Location: http://localhost/');
					exit();
				case '/edit_profile':
				?>
					<div class="notification is-success is-light">
						<p>You'r modifications have been recorded</p>
					</div>
				<?php
				

			}


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