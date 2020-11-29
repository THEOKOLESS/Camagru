<?php $title = 'Camagru - Montage'; ?>
<?php ob_start(); ?>
<body>
 


<div class="contentarea">
    <h1>
        Montage photo
    </h1>
    <?php include("view/message.php");?>
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

        <form  id="form" action="controller/ajaxupload.php" method="post" enctype="multipart/form-data">
            <div id="upload" class="hide">
                <input id="uploadImage" type="file" accept="image/*" name="image" /> <!--name = index de $_FILES -->
                <div id="preview"><img src="public/img/Upload.png" height="80" width="80"/></div><br>
                <input id="btn_upload" class="btn btn-success" type="submit" value="Upload">
            </div>
        </form>

        <script>
              
                // btn_upload = document.getElementById('btn_upload');
               
                // btn_upload.addEventListener('click', function(ev) {
                // ev.preventDefault();
                // var form = document.getElementById('form')
                // img = document.getElementById('uploadImage').files[0];
                // imgId = document.getElementById('uploadImage');
              
              
                // formData = new FormData(form);
                // var hr = new XMLHttpRequest();
                // hr.open("POST", "ajaxupload.php", true);
                // hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                // hr.onreadystatechange = function() {
                //     if(hr.readyState == 4 && hr.status == 200) {
                //             console.log(hr.responseText);
                //     }
                // }
                // form.append(imgId, img);
                // console.log(form);  
                // hr.send(form);
                // // var img =; 
                // // console.log(formData);
                // // makeRequest_upload('ajaxupload.php');
                // // accept_btn.classList.remove('hide');
                //  }, false);

            // function request_upload(path){

            // }

        </script>
        
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