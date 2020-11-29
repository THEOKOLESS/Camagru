<?php
	function social(){
		if(isset($_SESSION['id'])){
			echo 1;
		}
		else{
			echo 0;
		}
	}

	function liked($db, $id_photo){
		$reponse = $db->query('SELECT id_photo, id_user FROM likes');
        while ($donnees = $reponse->fetch()){
            if($donnees['id_photo'] == $id_photo && $donnees['id_user'] == $_SESSION['id']){
                return true;
            }
        }
        return false;
	}


    $sql = $db->query("SELECT id FROM photo");
    $tof = $sql->rowCount(); // number of photo
    $rpp = 5; //total photo by page
    $last = ceil($tof/$rpp); //// This tells us the page number of our last page
    if($last < 1){
        $last = 1;
    }
?>

<!DOCTYPE html>
<html>
<head>
<script>
var rpp = <?php echo $rpp; ?>; // results per page // get THIS IN A JS FILE to have the userID
var last = <?php echo $last; ?>; // last page number
function social_js(flag, like_nbr){
	let yoReturn =  '<div class="box">'
		if(<?php social($db) ?>)
		{
			// if(<?php //liked($db, $flag)?>)
			// 	yoReturn += '<img id="like' + flag + '"  onclick="likedornot()" src="public/img/no_like.png" class="thumb liked">'
			// else
				yoReturn += '<img id="like' + flag + '"  onclick="likedornot()" src="public/img/liked.png" class="liked">'
		}
		else
			yoReturn += '<img id="like' + flag + '"  onclick="not_log()" src="public/img/no_like.png" class="thumb liked">'
	
	yoReturn += '<span id="like_counter' + flag + '">' + like_nbr + '</span>'
	yoReturn += '</div>'

	return yoReturn
}

function request_page(pn){
	var results_box = document.getElementById("results_box");
	var pagination_controls = document.getElementById("pagination_controls");
	results_box.innerHTML = "loading results ...";
	var hr = new XMLHttpRequest();
    hr.open("POST", "pagination_parser.php", true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
			var dataArray = hr.responseText.split("||");
			var html_output = "";
			if(dataArray.length == 1)
				html_output ='<img src=public/img/galerie_vide.jpg>'
		    for(i = 0; i < dataArray.length - 1; i++){
				var yoArray = dataArray[i].split("|");
				// yoArray[0].innerHTML = social_js();
				// console.log(yoArray[3])
				
				
				// var itemArray =  '<div class="pic">' + yoArray[0] + social_js(yoArray[1], yoArray[3]) + '</div><hr>' // boucle dans le js
				var itemArray =  '<div class="pic">' + dataArray[i]+ '</div><hr>' // boucle dans le php
				html_output += itemArray;
			}
			results_box.innerHTML = html_output ;
	    }
    }
    hr.send("rpp="+rpp+"&last="+last+"&pn="+pn);
	// Change the pagination controls
	var paginationCtrls = "";
    // Only if there is more than 1 page worth of results give the user pagination controls
    if(last != 1){
		if (pn > 1) {
			paginationCtrls += '<button onclick="request_page('+(pn-1)+')">&lt;</button>';
    	}
		paginationCtrls += ' &nbsp; &nbsp; <b>Page '+pn+' of '+last+'</b> &nbsp; &nbsp; ';
    	if (pn != last) {
        	paginationCtrls += '<button onclick="request_page('+(pn+1)+')">&gt;</button>';
    	}
    }
	pagination_controls.innerHTML = paginationCtrls;
}
</script>

<?php 

require('view/Galerie/galerie_view.php'); ?>    
