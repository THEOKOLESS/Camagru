<?php $title = 'Camagru - Montage'; ?>
<?php ob_start(); ?>
   
   <h1>Prendre une photo</h1>
    <div class="control-group">
        <div class="camera">
            <video id="video">Video stream not available.</video>
        </div>
    </div>
    <div>
        <button id="startbutton">Prendre la photo</button>
    </div>
    <canvas id="canvas"></canvas>
<script src="view/Montage/take_picture.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>