
var httpRequest;

function showcom(x){

    var list = x.nextSibling.nextSibling
    if(event.target.classList.contains("com")){
        list.classList.toggle('hide');
    }
 
}

function post_com(x){
    let com = x.previousSibling.previousSibling.value;
    let photo = x.nextSibling.nextSibling.value;
    let com_counter = x.nextSibling.nextSibling.nextSibling.nextSibling;
    let com_nbr = parseInt(com_counter.value, 10); 
   
    if (com != ""){
        com_nbr += 1;
        // console.log(com_nbr);
        // console.log(com_counter);
        com_counter.setAttribute('value', com_nbr);
        console.log("ca pars");
        makeRequest('update_com.php', com, photo, com_nbr);
    }
    else
        alert("n'envoie pas de com vide wsh")
}

function makeRequest(url, com, photo, com_nbr) {

    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert('Abandon :( Impossible de créer une instance de XMLHTTP');
        return false;
      }
    httpRequest.onreadystatechange = ajax;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('com=' + encodeURIComponent(com) + '&file_pic_path=' + encodeURIComponent(photo) + '&com_nbr=' + encodeURIComponent(com_nbr)); // like = POST
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