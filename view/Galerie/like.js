
var httpRequest;

function likedornot(x){

    let like_counter = x.nextSibling.nextSibling;
    var like = parseInt(like_counter.value, 10); 
    var path = x.previousSibling.previousSibling.value

    if(event.target.classList.contains("thumb")){
        x.setAttribute('src', 'public/img/liked.png');
        x.classList.toggle('thumb');
        like += 1;
        like_counter.setAttribute('value', like);
        makeRequest('update_like.php', like, path);
    }  
    else {
        x.setAttribute('src', 'public/img/no_like.png');
        x.classList.toggle('thumb');
        like -= 1;
        like_counter.setAttribute('value', like);
        makeRequest('update_like.php', like, path);
    }     
}

function makeRequest(url, like, path) {

    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert('Abandon :( Impossible de créer une instance de XMLHTTP');
        return false;
      }
    httpRequest.onreadystatechange = ajax;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('like=' + encodeURIComponent(like) + '&file_pic_path=' + encodeURIComponent(path)); // like = POST
  }

function not_log_likedornot(){
    alert("vous devez vous connecter pour Liker en fait");
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