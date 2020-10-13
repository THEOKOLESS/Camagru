
function likedornot(x){
    let like_counter = x.nextSibling.nextSibling;
    var like = parseInt(like_counter.value, 10);
    
  
    if(event.target.classList.contains("thumb")){
        x.setAttribute('src', 'public/img/liked.png');
        x.classList.toggle('thumb');
        like += 1;
        like_counter.setAttribute('value', like);
    }  
    else {
        x.setAttribute('src', 'public/img/no_like.png');
        x.classList.toggle('thumb');
        like -= 1;
        like_counter.setAttribute('value', like);
    }   

    
    console.log(like);
}

function not_log_likedornot(){
    alert("vous devez vous connecter pour Liker en fait");
}