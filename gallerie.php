<?php
    function photo_from_bdd($db)
	{	
		$reponse = $db->query('SELECT file_pic_path FROM photo');
		while ($donnees = $reponse->fetch())
		{
            $pic = file_get_contents("upload/image/" . $donnees['file_pic_path'] . ".txt");
            ?>
                <img src=<?php echo $pic; ?>>
            <?php
		}	
    }
    photo_from_bdd($db);
    require('view/index_view.php'); 
?>