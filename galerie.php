<?php

    function liked($db, $path, $user_id){
        $reponse = $db->query('SELECT id_photo, id_user FROM likes');
        while ($donnees = $reponse->fetch()){
            if($donnees['id_photo'] == $path && $donnees['id_user'] == $user_id){
                return true;
            }
        }
        return false;
    }

    function name_com($db, $id_user_com, $com){
        $stmt = $db->prepare("SELECT username FROM users WHERE id LIKE :id");
        $stmt->execute(['id' => $id_user_com]);
        $res = $stmt->fetch();
        ?>
            <span style="color:#4682B4;">
        <?php
        echo $res['username']  . ': ';
        ?>
            </span>
        <?php 
        echo $com ;
    }

    function photo_from_bdd($db)
	{   	
        $flag = 0;
        $reponse = $db->query('SELECT id, file_pic_path FROM photo');
		while ($data = $reponse->fetch())
		{
            $img = $data['file_pic_path'];
            $id_photo = $data['id'];
            $like = $db->query("SELECT * FROM photo INNER JOIN likes ON photo.id=likes.id_photo WHERE photo.file_pic_path='".$img."'");  
            $com =  $db->query("SELECT * FROM photo INNER JOIN coms ON photo.id=coms.id_photo WHERE photo.file_pic_path='".$img."'"); 
            $flag += 1;
            $pic = file_get_contents("upload/image/" . $img . ".txt");
            ?>
                <div class="pic">
                    <img id="<?php echo "id_photo" . $flag;?>"src=<?php echo $pic;?>>
                    <div class="box">
                        <div>
                                <?php if (isset($_SESSION['id'])){?>
                                <input type="hidden" id=<?php echo "id_" . $flag;?> value="<?php echo $id_photo?>"> 
                                    <?php 
                                    if (!liked($db, $id_photo, $_SESSION['id'])){ 
                            ?>
                                            <img id="<?php echo "like" . $flag;?>" onclick="likedornot()" src="public/img/no_like.png" class="thumb liked">
                            <?php 
                                    }else{
                            ?>
                                            <img id="<?php echo "like" . $flag;?>" onclick="likedornot()" src="public/img/liked.png" class="liked">
                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <img id="<?php echo "like" . $flag;?>" onclick="not_log()" src="public/img/no_like.png" class="thumb liked">
                                    <?php } ?>
                                <span id="<?php echo "like_counter" . $flag;?>"><?php echo $like->rowCount();?></span>
                        </div>
                        <div>
                            <span class="com" id="<?php echo "count_com_id" . $flag;?>" onclick="showcom()">
                                <?php echo $com->rowCount() > 0 ? $com->rowCount() . " comments" :  $com->rowCount() . " comment" ;?> 
                            </span>
                        </div>
                    </div>
                    <div id="<?php echo "hidden_com" . $flag;?>" class="hide">
                            <input id="<?php echo "count_value" . $flag; ?>" type="text"
                            maxlength="200"
                            name="com"
                            class="input-xlarge"
                            placeholder="Votre commentaire"/>
                            <?php if (isset($_SESSION['id'])){?>
                            <input type="button" value="Poster mon super com"  onclick="post_com()" id="<?php echo "id->" . $flag; ?>"  />
                            <?php 
                                }else{ 
                            ?>
                                <input type="button" value="Poster mon super com"  onclick="not_log()" id="<?php echo "id->" . $flag; ?>"  />
                                <?php 
                                    }
                                ?>
                            <div class="coms_container" id="<?php echo "com_container" . $flag; ?>">
                                <?php 
                                    while($commentary = $com->fetch()){
                                        ?>
                                    <div>
                                        
                                        <?php
                                           name_com($db, $commentary['id_user'], $commentary['com']); 
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
        if(!$flag)
            return false;
        return true;
    }
  
    require('view/Galerie/galerie_view.php'); 
    include('pagination.php');
?>