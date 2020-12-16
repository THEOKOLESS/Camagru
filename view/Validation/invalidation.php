<?php $title = 'Erreur validation compte'; ?>
<?php ob_start(); ?>

    <p>Error ! Your account cannot be activated</p>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>