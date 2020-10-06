<?php $title = 'Camagru - Montage'; ?>
<?php ob_start(); ?>

<title>My Favorite Sport</title>
</head>

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
        <img id="photo" src="" alt="The screen capture will appear in this box."> 
       
    </div>
    <div id="picContainer">
        <img id="arryImages" src="public/img/cat.jpeg" class="thumb">
        <img id="arryImages" src="public/img/fire.jpg"class="thumb">
        <img id="arryImages" src="public/img/green fire.jpeg" class="thumb">
    </div>
     
</div>
   

<script src="view/Montage/select.js"></script>
<script src="view/Montage/take_picture.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>