<?php $title = '404 - Camagru'; ?>
<?php ob_start(); ?>

  <div class="center">
  <h1 class="title is-2">We are sorry</h1> 
    <img src="public/img/404-southpark1.jpg">
    <a href="/">Click here to go somewhere else</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>  