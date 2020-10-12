
function likedornot(x){
    console.log("ok");
    if(event.target.classList.contains("thumb")){
        x.setAttribute('src', 'public/img/liked.png');
        x.classList.toggle('thumb');
    }  
    else {
        x.setAttribute('src', 'public/img/no_like.png');
        x.classList.toggle('thumb');
    }   
}