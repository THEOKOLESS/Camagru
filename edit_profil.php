
<?php
session_start();
require 'config/setup.php';
$db = dbConnect();
$errors = array();
$username = '';
$email = '';
$pwd = '';
$new_pwd = '';
$new_pwd_bis = '';


function checkPassword($pwd, &$errors) {
    $errors_init = $errors;

    if (strlen($pwd) < 8) {
        $errors[] = "Votre Mot de passe doit contenir au moins 8 characteres!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one letter!";
    }
    if (!preg_match("#[a-z]+#", $pwd)) {
        $errors[] = "Password must include at least one lowercase letter!";
    }
    if (!preg_match("#[A-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one uppercase letter!";
    }

    return ($errors == $errors_init);
}

function check_log(){
    global $errors, $pwd, $db, $id;
    $id = $_SESSION['id'];
    $stmt = $db->prepare("SELECT pwd FROM users WHERE id LIKE :id");
    $stmt->execute(array('id' => $id));
    $res = $stmt->fetch();
    $isPasswordCorrect = password_verify($pwd, $res['pwd']);
    if (!$isPasswordCorrect)
    {
        return false;
    }
    return true;
}

function validate_form(){
    global $username, $email, $pwd, $new_pwd, $new_pwd_bis, $errors;
    
    if($_POST['username'] != '' && $_SESSION['username'] != $_POST['username']){
        $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        if($username != $_POST['username'] || strlen($username > 25) ){
            $errors[] = 'Nom d\'utilisateur invalide';
        }
    }else{
        $errors[] = 'Veuiller rentrer un nom d\'utilisateur';
    }

    if($_POST['email'] != '' && $_POST['email'] != $_SESSION['email']){
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email > 45)){
            $errors[] = 'Veuiller rentrer un email valide';
        }
    }else{
        $errors[] = 'Veuiller rentrer un email';
    }
    
    if($_POST['pwd'] != ''){
        $pwd = $_POST['pwd'];
         if (!check_log())
            $errors[] = 'MDP faux !';
    }else{
        $errors[] = 'Veuillez rentrer un mot de passe';
    }

    if($_POST['new_pwd'] != ''){
        $new_pwd = $_POST['new_pwd'];
        checkPassword($pwd, $errors);
    }else{
        $errors[] = 'Veuillez rentrer votre nouveau mot de passe';
    }

    if($_POST['new_pwd_bis'] != ''){
        $new_pwd_bis = $_POST['new_pwd_bis'];
        if ($new_pwd != $new_pwd_bis){
            $errors[] = 'Les mots de passe doivent correspondre';
        }
    }else{
        $errors[] = 'Veuillez répeter votre mot de passe';
    }
    if(count($errors)){
        return false;
    }else{
        return true;
    }
}

// function update_bdd(){
//     if ($_SESSION['username'] != $_POST['username']){
        
//     }
// }

function update_form(){
    if ($_SESSION['username'] != $_POST['username'] && $_SESSION['email'] != $_POST['email'] 
    AND $_POST['pwd'] AND $_POST['new_pwd'] AND $_POST['new_pwd_bis'])
            return true;
    return false;
}

function start_form(){
    global $errors;
    if(isset($_POST['submit']))
    {
        if (update_form())
        {
            if (validate_form())
                // update_bdd();
                echo "coucou";
        }
        else{
            $errors[] = "vous n'avez rien modifié...";
        }
    }
}

if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    start_form();

?>
<head>
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="menu.css">
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
	<form action="edit_profil.php" method="POST" class="form-horizontal">
		<fieldset>
			<legend>edition profil</legend>
			<?php include("message.php");?>
		<div class="control-group">
			<label for="username" class="control-label">USERNAME:</label>
			<div class="controls">
				<input type="text"
					   maxlength="25"
					   name="username"
					   id="username"
					   value="<?php echo $_SESSION['username'];?>"
					   class="input-xlarge"
					/>
			</div>
		</div>

		<div class="control-group">
			<label for="email" class="control-label">Email:</label>
			<div class="controls">
				<input type="email"
					   maxlength="45"
					   name="email"
					   id="email"
					   placeholder="Camagru@abc.fr"
					   value="<?php echo $_SESSION['email'];?>"
					   class="input-xlarge"
					   />
			</div>
		</div>

		<div class="control-group">
        <p>changer de Mdp</p>
			<label for="pwd" class="control-label">taper votre Mot de passe:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="pwd"
				       id="pwd"
				       class="input-xlarge"
				       placeholder="Mot de passe" />
			</div>
		</div>

        <div class="control-group">
			<label for="pwd_bis" class="control-label">nouveau mot de passe:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="new_pwd"
				       id="new_pwd"
				       class="input-xlarge"
				 />
			</div>
		</div>


		<div class="control-group">
			<label for="pwd_bis" class="control-label">répeter le mot de passe:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="new_pwd_bis"
				       id="new_pwd_bis"
				       class="input-xlarge"
				      />
			</div>
		</div>



		<div class="control-group">
			<div class="controls">
				<input type="submit" name="submit" value="Mettre à jour mon profil !" class="btn">
			</div>
		</div>
		</fieldset>
	</form>
</div>
</body>

<?php }
	else {
        header("Location: connexion.php");
     }?>