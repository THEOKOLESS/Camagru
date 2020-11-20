<?php
    $sql = $db->query("SELECT id FROM photo");
    $tof = $sql->rowCount(); // number of photo
    $rpp = 5; //total photo by page
    $last = ceil($tof/$rpp); //// This tells us the page number of our last page
    if($last < 1){
        $last = 1;
    }
    echo $last;
?>
<!DOCTYPE html>
<html>
<head>
<script>
var rpp = <?php echo $rpp; ?>; // results per page
var last = <?php echo $last; ?>; // last page number
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
		    for(i = 0; i < dataArray.length - 1; i++){
				var itemArray = dataArray[i]
				html_output += itemArray+ "</b><hr>";
			}
			results_box.innerHTML = html_output;
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
</head>
<body>
<div id="pagination_controls"></div>
<div id="results_box"></div>
<script> request_page(1); </script>
</body>
</html>
