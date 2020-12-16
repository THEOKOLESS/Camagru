<?php 


function photo_from_bdd($pic, $db, $id_photo, $com, $like){
    echo'  
    <div class="img1"> 
        <img  id=id_photo' . $id_photo . ' src=' . $pic .'>
    </div> 
    <div class="box">
        <div>';
    if(isset($_SESSION['id'])){ 
        if(!liked($db, $id_photo, $_SESSION['id'])){
            echo '<img id="like'. $id_photo . '" onclick="likedornot()" src="public/img/no_like.png" class="thumb liked">';
        }
        else{
            echo '<img id="like'. $id_photo . '" onclick="likedornot()" src="public/img/liked.png" class=" liked">';
        }
    }
    else{
            echo '<img id="like'. $id_photo . '" onclick="not_log()" src="public/img/no_like.png" class="thumb liked">';
    } 
    echo '<span class="up_like" id="like_counter' . $id_photo. '">' . $like->rowCount() . '</span>';
    echo '</div>
    <div>
        <span class="com" id="count_com_id' . $id_photo .'" onclick="showcom()">';
            echo $com->rowCount() > 0 ? $com->rowCount() . " comments" :  $com->rowCount() . " comment" ; 
    echo' </span>
        </div>
    </div>

    <div id="hidden_com' . $id_photo . '" class="hide in_box">
        <input id="count_value' . $id_photo . '" type="text"
                maxlength="200"
                name="com"
                class="input-xlarge"
                placeholder="lovely butterfly..."/>';
    if (isset($_SESSION['id'])){
        echo '<input type="button" class="btn btn-primary " value="Oh, what a useful com !"  onclick="post_com()" id="id->' . $id_photo .'"  />'; 
    }else{
    echo '<input type="button" class="btn btn-primary " value="Oh, what a useful com !"  onclick="not_log()" id="id->' . $id_photo .'"  />'; 

    }
    echo '<div class="coms_container" id="com_container' . $id_photo .'">';
    while($commentary = $com->fetch()){
        echo  '<div>';
        name_com($db, $commentary['id_user'], $commentary['com']); 
        echo '</div>';
        }
            
        echo ' </div>
        </div>';

        echo '</b>'.'||';

}