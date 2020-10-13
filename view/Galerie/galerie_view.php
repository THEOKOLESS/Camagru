<?php $title = 'Camagru'; ?>
<?php ob_start(); ?>
<div class="contentarea">
        <h1>Galerie</h1>
        <?php if (!photo_from_bdd($db)){
            ?><img src="public/img/galerie_vide.jpg">
        <?php
    }?>
</div>
<script src="view/Galerie/like.js"></script>
<script src="view/Galerie/com.js"></script>            
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>