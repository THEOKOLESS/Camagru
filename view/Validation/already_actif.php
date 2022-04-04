<?php $title = 'Compte déjà actif'; ?>
<?php ob_start(); ?>

    <p>You'r account is aleready actif !</p>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>