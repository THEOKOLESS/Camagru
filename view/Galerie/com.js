
// var httpRequest;

function showcom(){

  let id_com = event.target.id;
  let id = id_com.replace(/^\D+/g, "");
  var list = document.getElementById("hidden_com" + id);
    if(event.target.classList.contains("com")){
        list.classList.toggle('hide');
    }
    console.log("ENCULEEE")
}


function post_com(){
    let id_btn = event.target.id.replace(/^\D+/g, ""); /*get the id of button  to know where we are*/
    let id_photo = document.getElementById("id_photo" + id_btn).id.replace(/^\D+/g, "")
    let elem_com_nbr = document.getElementById("count_com_id" + id_btn)
    let com_nbr = parseInt(elem_com_nbr.innerHTML, 10)
    let com = document.getElementById("count_value" + id_btn);
    

    if (com.value != ""){
        com_nbr += 1;
        elem_com_nbr.textContent = com_nbr + " comments";
        makeRequest_com('update_com.php', com.value, id_photo);
        com.value = "";
    }
    else
        alert("n'envoie pas de com vide wsh")
}

function makeRequest_com(url, com, id_photo) {

    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert('Abandon :( Impossible de créer une instance de XMLHTTP');
        return false;
      }
    httpRequest.onreadystatechange = ajax_com;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('com=' + encodeURIComponent(com) + '&id_photo=' + encodeURIComponent(id_photo)); // like = POST
  }

  function ajax_com(){
    try {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
          if (httpRequest.status === 200) {
            // let id_btn = event.target.id.replace(/^\D+/g, ""); 
            // console.log(id_btn)
            var response = JSON.parse(httpRequest.responseText);
            let com_container = document.getElementById("com_container" + response.id_photo);
            // test in the array
            console.log(response.username + " : " + response.com);
            com_container.innerHTML += response.username + " : " + response.com
          } else {
            alert("A probleme occured during the com request.");
          }
        }
      }
      catch( e ) {
        console.log("a com dinguerie happened: " + e.description);
      }
}