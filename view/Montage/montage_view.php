<?php $title = 'Camagru - Montage'; ?>
<?php ob_start(); ?>
<body>
 


<div class="contentarea">
    <h1>
        Montage photo
    </h1>
    <div class="camera">
        <video id="video">Video stream not available.</video>
        <img id="not_available" src="public/img/sorry_image_not_available.jpg" class="hide">
        <img id="cat1" src="public/img/cat1.png" class="hide">
        <img id="cat2" src="public/img/cat2.png" class="hide">
        <img id="cat3" src="public/img/cat3.png" class="hide">
    </div>
    <div>
       
    </div>
    <canvas id="canvas">  Désolé, votre navigateur ne prend pas en charge &lt;canvas&gt;.</canvas>
    <form action="#" method="POST" name="picture">
        
            <input id="startbutton" type="button" value="prendre une photo" />
            <div class="output">
                <img id="photo" src="" class="hide"> 
            </div>
                <input type="hidden" id="photo_test" name="photo_test" value=""/><!-- fill in take_picture.js -->
                <button value="submit" id="accept_btn" class="hide" name="submit">accepter la photo</button>
    </form>

        <form  id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
            <div id="upload" class="hide">
                <input id="uploadImage" type="file" accept="image/*" name="image" />
                
                <div id="preview"><img src="public/img/Upload.png" height="80" width="80"/></div><br>
                <input id="btn_upload" class="btn btn-success" type="submit" value="Upload">
            </div>
        </form>
        
    <div id="picContainer">
        <img src="public/img/cat1.png" class="thumb">
        <img src="public/img/cat2.png" class="thumb">
        <img src="public/img/cat3.png" class="thumb">
    </div>

</div>
   

<script src="view/Montage/select.js"></script>
<script src="view/Montage/take_picture.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>