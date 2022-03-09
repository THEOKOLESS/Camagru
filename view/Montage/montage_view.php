<?php $title = 'Camagru - Montage'; ?>
<?php ob_start(); ?>
<body>
 


<div class="contentarea">
<h1 class="title is-1">
        Montage photo
</h1>
    <?php include("view/message.php");?>
    <div class="columns is-desktop">
        <div class="column">
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
            <form action="controller/ajaxupload.php" method="POST" name="picture">
                    <button id="startbutton" value="submit" type="submit" name="submit">take picture</button>
                        <input type="hidden" id="photo_test" name="photo_test" value=""/><!-- fill in take_picture.js -->
                        <br/>
                        <input type="hidden" id="selected_image" name="selected_image" value=""/>
            </form>

                <form  id="form" action="controller/ajaxupload.php" method="post" enctype="multipart/form-data"  class="form-control">
                    <div id="upload" >
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
        <div id="photo_taken" class="column is-one-fifth">
               <?php
                   $sql = $db->prepare("SELECT id FROM photo WHERE id_user LIKE :id  ORDER BY id DESC" );
                   $sql->execute(['id' => $_SESSION['id']]);
                    if($sql->rowCount()){
                        $flag = 0;
                        while($donnes = $sql->fetch()){
                            $img = $donnes['file_pic_path'];
                            $pic = strpos($img, ".") === false ?  "/upload/image/" . $img . ".jpeg" :   "/upload/image/" . $img;
                            echo'<img id="montage_pic' . $flag. '" src="' . $pic . '" onclick="delete_pic()">';
                            $flag++;
                        }
                    }
                    else {
                        echo'<script>let col= document.getElementById("photo_taken");
                        col.classList.add("hide");
                        </script>';
                    }
               ?>     
        </div>
    </div>
 
</div> 

<script src="view/Montage/select.js"></script>
<script src="view/Montage/take_picture.js"></script>

<script>
function delete_pic(){
    id_flag_pic = event.target.id.replace(/^\D+/g, "")
    elem_pic = document.getElementById("montage_pic"+id_flag_pic)
    pic = elem_pic.src.split('/').pop();
    if (confirm('Are you sure you want to delete this amazing photo ?')) {
        elem_pic.parentNode.removeChild(elem_pic);
        makeRequest_del_pic('model/del_pic.php', pic);  
    }
}

function makeRequest_del_pic(url, pic){
    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert('Abandon :( Impossible de créer une instance de XMLHTTP');
        return false;
      }
    httpRequest.onreadystatechange = ajax_del_pic;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('pic=' + encodeURIComponent(pic));
}

function ajax_del_pic(){
    try {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
          if (httpRequest.status === 200) {
            var response = JSON.parse(httpRequest.responseText);
            console.log(response.sql);

          } else {
            alert("A probleme occured during the com request.");
          }
        }
      }
      catch( e ) {
        console.log("a photo del dinguerie happened: " + e.description);
      }
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>