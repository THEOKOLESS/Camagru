<?php $title = 'Camagru - Montage'; ?>
<?php ob_start(); ?>
<body>
 


<div class="contentarea">
    <h1>
        Montage photo
    </h1>
    <div class="camera">
        <video id="video">Video stream not available.</video>
        <img id="main" src="" class="hide">
    </div>
    <div>
       
    </div>
    <canvas id="canvas">  Désolé, votre navigateur ne prend pas en charge &lt;canvas&gt;.</canvas>
    <button id="startbutton">Prendre une photo</button>
    <div class="output">
        <img id="photo" src="" class="hide"> 
       
    </div>
    <div id="picContainer">
        <img id="arryImages" src="public/img/cat1.png" class="thumb">
        <img id="arryImages" src="public/img/cat2.png" class="thumb">
        <img id="arryImages" src="public/img/cat3.png" class="thumb">
    </div>
     
</div>
   

<script src="view/Montage/select.js"></script>
<script src="view/Montage/take_picture.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>