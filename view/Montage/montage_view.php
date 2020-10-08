<?php $title = 'Camagru - Montage'; ?>
<?php ob_start(); ?>
<body>
 


<div class="contentarea">
    <h1>
        Montage photo
    </h1>
    <div class="camera">
        <video id="video">Video stream not available.</video>
        <img id="cat1" src="public/img/cat1.png" class="hide">
        <img id="cat2" src="public/img/cat2.png" class="hide">
        <img id="cat3" src="public/img/cat3.png" class="hide">
    </div>
    <div>
       
    </div>
    <canvas id="canvas">  Désolé, votre navigateur ne prend pas en charge &lt;canvas&gt;.</canvas>
    <button id="startbutton"  type="test" name="test">Prendre une photo</button>
    <div class="output">
        <img id="photo" src="" class="hide">    
        <img id="photo_test" src="" >   
    </div>
    <div id="picContainer">
        <img src="public/img/cat1.png" class="thumb">
        <img src="public/img/cat2.png" class="thumb">
        <img src="public/img/cat3.png" class="thumb">
    </div>

 <label>Vore nom : 
  <input type="text" id="ajaxTextbox" />
</label>
<span id="ajaxButton" style="cursor: pointer; text-decoration: underline">
  Lancer une requête
</span>

</div>
   

<script src="view/Montage/select.js"></script>
<script src="view/Montage/take_picture.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>