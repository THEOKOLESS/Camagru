<?php 
session_start();// onlige, jsp pk on l'a pas 
require '../config/setup.php';

    if (isset($_POST['like'])){
        $like = $_POST['like']; //like nbr
        $user_id = $_SESSION['id']; 
        $id_photo = $_POST['id_photo'];
        $flag = 0;

        $reponse = $db->query('SELECT id_photo, id_user FROM likes'); /* like en fonction des users */ 
        while ($donnees = $reponse->fetch())
		{
			if($donnees['id_photo'] == $id_photo && $donnees['id_user'] == $user_id){
                $req = $db->prepare("DELETE FROM `likes` WHERE `id_photo`='".$id_photo."' AND `id_user`='".$user_id."';");
                $req->execute();
                $flag += 1; 
			}
        }	

        if (!$flag){
            $req = $db->prepare('INSERT INTO likes(id_photo, id_user) VALUES(:id_photo, :id_user)');
            $req->execute(array(
                'id_photo' => $id_photo,
                'id_user' =>  $user_id
            ));
        }
    }

        
    