<?php $title = 'Compte activé'; ?>
<?php ob_start(); ?>

    <p>Your account is activated  !"</p>
    <p>Congratulation !!</p>
    <a href="connexion">Connect therefore here</a>
     
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>