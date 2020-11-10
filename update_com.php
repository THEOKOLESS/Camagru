<?php 
session_start();// onlige, jsp pk on l'a pas 
require 'config/setup.php';

    if (isset($_POST['com'])){

        $com = $_POST['com'];
        $id_photo = $_POST['id_photo'];
        $user_id = $_SESSION['id']; 
        $test = "la photo ; " . $id_photo ." a ce com : " . $com . "avec l'user id " . $user_id . "c'est son " . $com_nbr . "eme com en fait";
        $array = ['test' => $test];
        $flag = 0;    
        // $reponse = $db->query('SELECT file_pic_path, id_user FROM coms'); /* like en fonction des users */ 
        // while ($donnees = $reponse->fetch())
		// {
		// 	if($donnees['file_pic_path'] == $path && $donnees['id_user'] == $user_id){
        //         $req = $db->prepare("DELETE FROM `coms` WHERE `file_pic_path`='".$path."' AND `id_user`='".$user_id."';");
        //         $req->execute();
        //         $flag += 1; 
		// 	}
        // }	

        if (!$flag){
            $req = $db->prepare('INSERT INTO coms(id_user, id_photo, com) VALUES( :id_user, :id_photo, :com)');
            $req->execute(array(
                'id_user' =>  $user_id,
                'id_photo' => $id_photo,
                'com' => $com
            ));
        }
        echo json_encode($array);
    }
