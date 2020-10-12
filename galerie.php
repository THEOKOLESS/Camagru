<?php
    function photo_from_bdd($db)
	{	
        $flag = 0;
	    $reponse = $db->query('SELECT file_pic_path FROM photo');
		while ($donnees = $reponse->fetch())
		{
            $flag += 1;
            $pic = file_get_contents("upload/image/" . $donnees['file_pic_path'] . ".txt");
            ?>
                <div class="pic">
                    <img src=<?php echo $pic;?>>
                    <div class="box">
                        <div>
                        <p> <img id="like" onclick="likedornot(this)" src="public/img/no_like.png" class="thumb liked">: 0</p>
                        </div>
                        <div>
                            <p>0 commentaire(s)</p>
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
?>