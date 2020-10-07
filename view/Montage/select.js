
        let cat1 = document.getElementById("cat1");
        let cat2 = document.getElementById("cat2");
        let cat3 = document.getElementById("cat3");

        document.addEventListener("click", function(event){
            // Check to see if the clicked element is a thumbnail
           
            if(event.target.classList.contains("thumb")){
                var selected = event.target.src.split("/").pop();
                if(event.target.classList.contains("select"))
                {
                    event.target.classList.remove('select');
                    if (selected == "cat1.png"){
                        cat1.classList.add('hide');  
                    }
                    if (selected == "cat2.png"){
                        cat2.classList.add('hide');  
                    }
                    if (selected == "cat3.png"){
                        cat3.classList.add('hide');  
                    }
            }else
                {
                    event.target.classList.add('select')
                    if (selected == "cat1.png"){
                        cat1.classList.remove('hide');  
                    }
                    if (selected == "cat2.png"){
                        cat2.classList.remove('hide');  
                    }
                    if (selected == "cat3.png"){
                        cat3.classList.remove('hide');  
                    }
                }
                // console.log(selected);
                // main.src = event.target.src;  // Set main picture to match the thumbnail
                // main.classList.remove('hide');  
            }
          });

