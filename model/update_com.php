<?php 
session_start();
require '../config/setup.php';

function send_com_mail($dest_email, $username){
    $destinataire = $dest_email;
  
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers

$headers .= 'From: Unsuspisious guy <safe@big.hack>' . "\r\n";

     
$sujet = $username . ' commented your photo !!!' ;

$message = "<html><body>
<p>Awesomness !! ". $username . " commented your photo, go check fast what this person had to say on " . "<a href=\"http://localhost/\">Camagru</a>. "."I'am sure it is a warm one ! :P </p>
</body>
</html>" ;

    if(!mail($destinataire, $sujet, $message, $headers)){
        return(false);
   }
   return(true);
}


    if (isset($_POST['com'])){

        $com = $_POST['com'];
        $id_photo = $_POST['id_photo'];
        $user_id = $_SESSION['id']; 
        $username = $_SESSION['username'];
        $user_email = $_SESSION['email'];

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

            $stmt = $db->prepare("SELECT  email, email_on_com, users.id from users INNER JOIN photo on photo.id_user=users.id WHERE photo.id LIKE :ids");
            $stmt->execute(array(
            'ids' => $id_photo));
            $res = $stmt->fetch();
            if ($res[2] != $user_id && $res[1] == 1){
                if(send_com_mail($res[0], $username)){
                    $flag= 'mail sent from ' . $username . ' to '. $res[0] ;
                }
            }
            else{
                $flag = "mail not sent !";
            }
        }
        $array = ['username' => $username, 'com' => $com, 'id_photo_lol' => $id_photo, 'flag' => $flag];

        echo json_encode($array);
    }
