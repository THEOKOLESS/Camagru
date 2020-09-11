<?php $title = 'Compte déjà actif'; ?>
<?php ob_start(); ?>

    <p>Votre compte est déjà actif !"</p>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>