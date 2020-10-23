
var httpRequest;

function showcom(x){

    var list = x.nextSibling.nextSibling
    if(event.target.classList.contains("com")){
        list.classList.toggle('hide');
    }
 
}

function post_com(x){
    let id_btn = event.target.id.replace(/^\D+/g, "");
    let id_photo = document.getElementById("id_photo" + id_btn).id.replace(/^\D+/g, "")
    let elem_com_nbr = document.getElementById("count_com_id" + id_btn)
    let com_nbr = parseInt(elem_com_nbr.value, 10)
    let com = document.getElementById("count_value" + id_btn).value;

    if (com != ""){
        com_nbr += 1;
        console.log(id_photo);
        elem_com_nbr.setAttribute('value', com_nbr);
        makeRequest('update_com.php', com, id_photo, com_nbr);
    }
    else
        alert("n'envoie pas de com vide wsh")
}

function makeRequest(url, com, id_photo, com_nbr) {

    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert('Abandon :( Impossible de créer une instance de XMLHTTP');
        return false;
      }
    httpRequest.onreadystatechange = ajax;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('com=' + encodeURIComponent(com) + '&id_photo=' + encodeURIComponent(id_photo) + '&com_nbr=' + encodeURIComponent(com_nbr)); // like = POST
  }

  function ajax(){
    try {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
          if (httpRequest.status === 200) {
            var response = JSON.parse(httpRequest.responseText);
            // return response.json();
            alert(response.test); // test in the array
            console.log('success!');
          } else {
            alert("Un problème est survenu au cours de la requête.");
          }
        }
      }
      catch( e ) {
        alert("Une exception s’est produite : " + e.description);
      }
}