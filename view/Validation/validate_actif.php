<?php $title = 'Compte activé'; ?>
<?php ob_start(); ?>

    <p>Votre compte a bien été activé !"</p>
    <p>Felicitation !!</p>
    <a href="controller/connexion">vous pouvez desormais vous connecter</a>
     
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>