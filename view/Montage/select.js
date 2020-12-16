
        let cat1 = document.getElementById("cat1");
        let cat2 = document.getElementById("cat2");
        let cat3 = document.getElementById("cat3");
        let button = document.getElementById("startbutton");


    function is_smth_selectd(){
        if (!document.getElementsByClassName('select')[0]){
            button.disabled = true;
            button.style.backgroundColor = "#d3d3d3";
            button.style.cursor = "not-allowed"
        }
        else{
            button.disabled = false;
            button.style.backgroundColor = "green";
            button.style.cursor = "pointer";
        }
    }

        is_smth_selectd();
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
                    is_smth_selectd();
                    console.log(document.getElementsByClassName('select')[0])
            }else
                {
                    var els = document.getElementsByClassName('select')
                    while (els[0]) {
                        cat1.classList.add('hide');  
                        cat2.classList.add('hide');  
                        cat3.classList.add('hide');  
                        els[0].classList.remove('select')
                      }
                    event.target.classList.add('select')
                    is_smth_selectd();
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
            }
          });

        