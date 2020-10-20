<?php 
session_start();// onlige, jsp pk on l'a pas 
require 'config/setup.php';

    if (isset($_POST['like'])){
        $like = $_POST['like'];
        $path = $_POST['file_pic_path'];
        $user_id = $_SESSION['id']; 
        $test = "la photo ; " . $path ." a " . $like . "like" . "avec l'user id " . $user_id;
        $array = ['like' => $like, 'path' => $path, 'test' => $test];
        $sql = "UPDATE photo SET like_nbr=? WHERE file_pic_path=?";
        $flag = 0;

        $db->prepare($sql)->execute([$like, $path]);/* nombre de like sur la photo*/

        
        $reponse = $db->query('SELECT file_pic_path, id_user FROM likes'); /* like en fonction des users */ 
        while ($donnees = $reponse->fetch())
		{
			if($donnees['file_pic_path'] == $path && $donnees['id_user'] == $user_id){
                $req = $db->prepare("DELETE FROM `likes` WHERE `file_pic_path`='".$path."' AND `id_user`='".$user_id."';");
                $req->execute();
                $flag += 1; 
			}
        }	

        if (!$flag){
            $req = $db->prepare('INSERT INTO likes(file_pic_path, id_user) VALUES(:file_pic_path, :id_user)');
            $req->execute(array(
                'file_pic_path' => $path,
                'id_user' =>  $user_id
            ));
        }
        echo json_encode($array);
    }

        
    