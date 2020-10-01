<?php $title = 'Erreur validation compte'; ?>
<?php ob_start(); ?>

    <p>Erreur ! Votre compte ne peut être activé...</p>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>