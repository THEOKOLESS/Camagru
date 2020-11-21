<?php $title = 'Camagru'; ?>
<?php ob_start(); ?>
<div class="contentarea">
    <h1>Galerie</h1>
    <div id="pagination_controls"></div>
    <div id="results_box"></div>    
</div>
<script src="view/Galerie/like.js"></script>
<script src="view/Galerie/com.js"></script>
<script>request_page(1)</script>  
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>