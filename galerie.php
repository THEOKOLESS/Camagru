<?php
    // if (isset($_POST['like'])){
    //     echo "yo";
    //     $like = $_POST['like'];
    //     $array = ['like' => $like];
    //     echo json_encode($array);

    // }
    // function update_bdd_like($db, $like, $pic)
    // {   
    //     echo "UPDAATE ???  :   " . $like;
    //     $sql = "UPDATE photo SET like_nbr=? WHERE file_pic_path=?";
    //     $db->prepare($sql)->execute([$like, $pic]);
    // }


    function liked($db, $path, $user_id){
        $reponse = $db->query('SELECT file_pic_path, id_user FROM likes');
        while ($donnees = $reponse->fetch()){
            if($donnees['file_pic_path'] == $path && $donnees['id_user'] == $user_id){
                return true;
            }
        }
        return false;
    }

    function photo_from_bdd($db)
	{   	
        $flag = 0;
        $reponse = $db->query('SELECT id, file_pic_path, like_nbr, com_nbr FROM photo');
		while ($data = $reponse->fetch())
		{
            $img = $data['file_pic_path'];
            $id_photo = $data['id'];
            $like_nbr = $data['like_nbr'];  
            $com =  $db->query("SELECT * FROM photo INNER JOIN coms ON photo.id=coms.id_photo WHERE photo.file_pic_path='".$img."'"); 
            $flag += 1;
            $pic = file_get_contents("upload/image/" . $img . ".txt");
            ?>
                <div class="pic">
                    <img id="<?php echo "id_photo" . $flag;?>"src=<?php echo $pic;?>>
                    <div class="box" onclick="showcom(this)">
                        <div>
                                <?php if (isset($_SESSION['id'])){?>
                                <input type="hidden" id=<?php echo "id_" . $flag;?> value="<?php echo $img?>"> 
                                    <?php 
                                    if (!liked($db, $img, $_SESSION['id'])){ 
                            ?>
                                            <img id="like" onclick="likedornot(this)" src="public/img/no_like.png" class="thumb liked">
                            <?php 
                                    }else{
                            ?>
                                            <img id="like" onclick="likedornot(this)" src="public/img/liked.png" class="liked">
                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <img id="like" onclick="not_log_likedornot()" src="public/img/no_like.png" class="thumb liked">
                                    <?php } ?>
                                <input type="number" value="<?php echo $like_nbr;?>" readonly>
                        </div>
                        <div>
                            <span class="com">
                                <input type="number" id="<?php echo "count_com_id" . $flag;?>" value="<?php echo $com->rowCount();?>" readonly > Commentaire(s) :
                                 </span>
                        </div>
                    </div>
                    <div class="hide">

                        <input id="<?php echo "count_value" . $flag; ?>" type="text"
                        maxlength="200"
                        name="com"
                        class="input-xlarge"
                        placeholder="Votre commentaire"/>
                        <input type="button" value="Poster mon super com"  onclick="post_com(this)" id="<?php echo "id->" . $flag; ?>"  />

                        <div class="coms_container">
                            <?php 
                                while($commentary = $com->fetch()){
                                    ?>
                                    <div>
                                    <?php
                                  echo $commentary['com'];  
                                  ?>
                                  </div>
                                  <?php
                                }
                            ?>
                        </div>
                    </div>
                    <hr>  
                </div>
            <?php
        }
        // var_dump($com_nbr);
        if(!$flag)
            return false;
        return true;
    }
  
    require('view/Galerie/galerie_view.php'); 
?>