<?php
session_start(); //si, ca marche pas cest pck on voit pas l'erreur ici mais la session existe bel et bien...


function name_com($db, $id_user_com, $com){
    $stmt = $db->prepare("SELECT username FROM users WHERE id LIKE :id");
    $stmt->execute(['id' => $id_user_com]);
    $res = $stmt->fetch();
    echo  '<span style="color:#4682B4;">';
    echo $res['username']  . ': ';
    echo '</span>';
    echo $com ;
}

function liked($db, $path, $user_id){
    $reponse = $db->query('SELECT id_photo, id_user FROM likes');
    while ($donnees = $reponse->fetch()){
        if($donnees['id_photo'] == $path && $donnees['id_user'] == $user_id){
            return true;
        }
    }
    return false;
}
// Make the script run only if there is a page number posted to this script
if(isset($_POST['pn'])){
	$rpp = preg_replace('#[^0-9]#', '', $_POST['rpp']);
	$last = preg_replace('#[^0-9]#', '', $_POST['last']);
	$pn = preg_replace('#[^0-9]#', '', $_POST['pn']);
	// This makes sure the page number isn't below 1, or more than our $last page
	if ($pn < 1) { 
    	$pn = 1; 
	} else if ($pn > $last) { 
    	$pn = $last; 
    }
    
	// Connect to our database here
    require '../config/setup.php';
    require '../view/Galerie/seen_galerie.php';


	// This sets the range of rows to query for the chosen $pn
	$limit = 'LIMIT ' .($pn - 1) * $rpp .',' .$rpp;
	// This is your query again, it is for grabbing just one page worth of rows by applying $limit
	$sql = $db->query("SELECT id, file_pic_path FROM photo ORDER BY id DESC $limit");
    $dataString = '';
	while($data = $sql->fetch()){
        $img = $data['file_pic_path'];
        $id_photo = $data['id'];
        $like = $db->query("SELECT * FROM photo INNER JOIN likes ON photo.id=likes.id_photo WHERE photo.file_pic_path='".$img."'");  
        $com =  $db->query("SELECT * FROM photo INNER JOIN coms ON photo.id=coms.id_photo WHERE photo.file_pic_path='".$img."'"); 
        $pic = strpos($img, ".jpeg") !== false ?  "../" . $img  :   "../upload/image/" . $img; 

        $dataString .= photo_from_bdd($pic, $db, $id_photo, $com, $like);
    }
    
	// Echo the results back to Ajax
	// echo $dataString;
	exit();
}
?>