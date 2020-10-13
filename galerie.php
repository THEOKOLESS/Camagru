<?php

    function update_bdd_like($db, $like, $pic)
    {   
        echo $like;
        $sql = "UPDATE photo SET like_nbr=? WHERE file_pic_path=?";
        $db->prepare($sql)->execute([$like, $pic]);
    }
    function photo_from_bdd($db)
	{   	
        $flag = 0;
        $reponse = $db->query('SELECT file_pic_path, like_nbr FROM photo');
		while ($data = $reponse->fetch())
		{
            $like_nbr = $data['like_nbr'];
            $img = $data['file_pic_path'];
            $flag += 1;
            $pic = file_get_contents("upload/image/" . $img . ".txt");
            ?>
                <div class="pic">
                    <img src=<?php echo $pic;?>>
                    <div class="box"onclick="showcom(this)">
                        <div>
                                <?php if (isset($_SESSION['id'])){?>
                    <!-- AJAXXXXX -->
                                    <img id="like" onclick="likedornot(this)" src="public/img/no_like.png" class="thumb liked">
                                    <?php }
                                    else{
                                        ?>
                                        <img id="like" onclick="not_log_likedornot()" src="public/img/no_like.png" class="thumb liked">
                                    <?php } ?>
                                <input type="number" value="<?php echo $like_nbr;?>" readonly>
                        </div>
                        <div >
                            <span class="com">X Commentaire(s) : </span>
                        </div>
                    </div>
                    <div class="hide">

                        <input type="text"
                        maxlength="200"
                        name="com"
                        class="input-xlarge"
                        placeholder="Votre commentaire"/>
                        
                    </div>
                    <hr>  
                </div>
            <?php
             update_bdd_like($db, $like_nbr, $img);
        }	
        if(!$flag)
            return false;
        return true;
    }
  
    require('view/Galerie/galerie_view.php'); 
?>