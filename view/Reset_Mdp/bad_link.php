<?php $title = 'Mauvais Lien de reset de MDP'; ?>
<?php ob_start(); ?>
            <h2>Mauvais lien</h2>
            <p>le liens n'est pas bon</p>
            <p><a href="enter_email">
            Click here</a> to reset password.</p>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>