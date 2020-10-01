<?php $title = 'Profile - Camagru'; ?>
<?php ob_start(); ?>
<div class="center">
         <h2>Profil de <?php echo $username; ?></h2>
         <br /><br />
         Mail : <?php echo $email; ?>
         <br />
         <br />
         <a href="edit_profile">Editer mon profil</a>
         <a href="controller/deco.php">Se déconnecter</a>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>