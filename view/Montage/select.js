
        let main = document.getElementById("main");
        document.addEventListener("click", function(event){
            // Check to see if the clicked element is a thumbnail
            if(event.target.classList.contains("thumb")){
              main.src = event.target.src;  // Set main picture to match the thumbnail
              main.class = ""
            }
          });

