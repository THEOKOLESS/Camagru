<?php
// session_start();
// echo( $_SESSION['id']);
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
    require 'config/setup.php';
    function photo_from_bdd($flag, $pic, $db, $id_photo, $com, $like){
        echo'   
                <img id=id_photo' . $flag . ' src=' . $pic .'>
           
         '  ;
        ?>
                <div class="box">
                    <div>
                        <?php   if(isset($_SESSION['id'])){
                              echo '2'; 
                             ?>
                                    <input type="hidden" id=<?php echo "id_" . $flag;?> value="<?php echo $id_photo?>"> 
                        <?php 
                                if(!liked($db, $id_photo, $_SESSION['id'])){
                                    echo '1'; 
                        ?>
                                    <img id="<?php echo "like" . $flag;?>" onclick="likedornot()" src="public/img/no_like.png" class="thumb liked">
                        <?php 
                                }
                                else{
                                    echo '3'; 
                        ?>
                                    <img id="<?php echo "like" . $flag;?>" onclick="likedornot()" src="public/img/liked.png" class="liked">
                        <?php
                            }
                        }
                        else{
                            echo '4'; 
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
        <?php
         echo '</b><hr>'.'||';

    }
	// This sets the range of rows to query for the chosen $pn
	$limit = 'LIMIT ' .($pn - 1) * $rpp .',' .$rpp;
	// This is your query again, it is for grabbing just one page worth of rows by applying $limit
	$sql = $db->query("SELECT id, file_pic_path FROM photo ORDER BY id DESC $limit");
	// $query = mysqli_query($db_conx, $sql);
    $dataString = '';
    $flag=0;
	while($data = $sql->fetch()){
        $img = $data['file_pic_path'];
        $id_photo = $data['id'];
        $like = $db->query("SELECT * FROM photo INNER JOIN likes ON photo.id=likes.id_photo WHERE photo.file_pic_path='".$img."'");  
        $com =  $db->query("SELECT * FROM photo INNER JOIN coms ON photo.id=coms.id_photo WHERE photo.file_pic_path='".$img."'"); 
        $flag += 1;
    //    if(strpos($img, ".") === false)
    //         $pic = file_get_contents("upload/image/" . $img . ".txt");    
    //     else
    //         $pic = "upload/image/" . $img; 
        $pic = strpos($img, ".") === false ?  file_get_contents("upload/image/" . $img . ".txt") :   "upload/image/" . $img; 
        // $pic = ($pic = file_get_contents("upload/image/" . $img . ".txt")) ? $pic : "upload/image/" . $img;
        // $pic ? $pic = $pic : "upload/image/" . $img; 
        // $dataString .=  '<img id=' . 'id_photo' . $flag . ' src=' . $pic . '> ' . '||';
         $dataString .= photo_from_bdd($flag, $pic, $db, $id_photo, $com, $like);
    
	}
	// Close your database connection
	// Echo the results back to Ajax
	echo $dataString;
	exit();
}
?>