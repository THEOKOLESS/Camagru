<?php $title = 'Mauvais Lien de reset de MDP'; ?>
<?php ob_start(); ?>
            <h2 class="title is-2">Bad link</h2>
          
            <p><a href="enter_email">
            Click here</a> to reset password.</p>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>