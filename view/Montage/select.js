
        let main = document.getElementById("main");
        document.addEventListener("click", function(event){
            // Check to see if the clicked element is a thumbnail
            if(event.target.classList.contains("thumb")){
                if(event.target.classList.contains("select"))
                    event.target.classList.remove('select');
                else
                    event.target.classList.add('select')
                main.src = event.target.src;  // Set main picture to match the thumbnail
                main.classList.remove('hide');  
            }
          });

