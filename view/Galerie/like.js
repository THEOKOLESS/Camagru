
var httpRequest;

function likedornot(){
    let id_like = event.target.id;
    let id = id_like.replace(/^\D+/g, "");
    let like_btn = document.getElementById(id_like);
    let like_counter = document.getElementById("like_counter"+ id);
    var like = parseInt(like_counter.innerHTML, 10); 
    var id_photo = document.getElementById("id_" + id).value
   
    if(like_btn.classList.contains("thumb")){
        like_btn.setAttribute('src', 'public/img/liked.png');
        like_btn.classList.toggle('thumb');
        like += 1; 
        like_counter.textContent = like;
        makeRequest_like('update_like.php', like, id_photo);
    }  
    else {
      like_btn.setAttribute('src', 'public/img/no_like.png');
      like_btn.classList.toggle('thumb');
        like -= 1;
        like_counter.textContent = like;
        makeRequest_like('update_like.php', like, id_photo);
    }     
}

function makeRequest_like(url, like, id_photo) {

    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert('Abandon :( Impossible de créer une instance de XMLHTTP');
        return false;
      }
    httpRequest.onreadystatechange = ajax_like;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('like=' + encodeURIComponent(like) + '&id_photo=' + encodeURIComponent(id_photo)); // like = POST
  }

function not_log(){
  alert("You have to be connected to like or comment");
}

function ajax_like(){
    try {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
          console.log('like success!');
          if (httpRequest.status === 200) {
            // var response = JSON.parse(httpRequest.responseText);
            // return response.json();
            // alert(response.test); // test in the array
            
          } else {
            alert("Un problème est survenu au cours de la requête.");
          }
        }
      }
      catch( e ) {
        alert("Une exception s’est occured : " + e.description);
      }
}