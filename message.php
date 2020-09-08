<?php 
	if(isset($_POST['submit'])){
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if(count($errors) === 0 && $actual_link == 'http://localhost:8080/register.php'){
		?>
			<div class="alert alert-success">
				<p>Vous allez recevoir un mail de confirmation a l'adresse indique</p>
			</div>
		<?php
        }else if(count($errors) === 0 && $actual_link == 'http://localhost:8080/enter_email.php'){
        ?>
			<div class="alert alert-success">
				<p>Vous allez recevoir un mail de reinitialisation a l'adresse indique</p>
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