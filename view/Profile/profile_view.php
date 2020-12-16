<?php $title = 'Profile - Camagru'; ?>
<?php ob_start(); ?>
    <div class="center">
         <h2 class="title is-2">Hello <?php echo ucfirst($username); ?></h2>
         <br /><br />
        <p> Email : <?php echo $email; ?> </p>
         <br />
         <br />
         <a href="edit_profile">Edit my profile</a> 
         <br/>
         <a href="controller/deco.php">Log out</a>
    </div>
   
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>