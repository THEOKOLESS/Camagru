<?php $title = 'Mauvais Lien de reset de MDP'; ?>
<?php ob_start(); ?>

            <h2>Link Expired</h2>
            <p>The link is expired. You are trying to use the expired link which 
            as valid only 24 hours (1 days after request).<br /><br /></p>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>