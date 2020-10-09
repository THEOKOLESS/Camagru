
// (function() {

//     var streaming = false,
//         video        = document.querySelector('#video'),
//         cover        = document.querySelector('#cover'),
//         canvas       = document.querySelector('#canvas'),
//         photo        = document.querySelector('#photo'),
//         startbutton  = document.querySelector('#startbutton'),
//         width = 320,
//         height = 0;
  
//     navigator.getMedia = ( navigator.getUserMedia ||
//                            navigator.webkitGetUserMedia ||
//                            navigator.mozGetUserMedia ||
//                            navigator.msGetUserMedia);
  
//     navigator.getMedia(
//       {
//         video: true,
//         audio: false
//       },
//       function(stream) {
//         if (navigator.mozGetUserMedia) {
//           video.mozSrcObject = stream;
//           console.log("MOZILLA");
//         } else {
//           video.srcObject = stream;
//         }
//         video.play();
//       },
//       function(err) {
//         console.log("An error occured! " + err);
//       }
//     );
  
//     video.addEventListener('canplay', function(ev){
//       if (!streaming) {
//         height = video.videoHeight / (video.videoWidth/width);
//         video.setAttribute('width', width);
//         video.setAttribute('height', height);
//         canvas.setAttribute('width', width);
//         canvas.setAttribute('height', height);
//         streaming = true;
//       }
//     }, false);
  
//     function takepicture() {
//       canvas.width = width;
//       canvas.height = height;
//       canvas.getContext('2d').drawImage(video, 0, 0, width, height);
//       var data = canvas.toDataURL('image/png');
//       photo.setAttribute('src', data);
//       console.log(photo.src);
//       window.location.href="montage?photo_src=" + photo.src;
//     }
  
//     startbutton.addEventListener('click', function(ev){
//         takepicture();
//       ev.preventDefault();
//     }, false);
  
//   })();
(function() {

  var width = 320; // We will scale the photo width to this
  var height = 0; // This will be computed based on the input stream

  var streaming = false;

  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;

  function startup() {
      video = document.getElementById('video');
      canvas = document.getElementById('canvas');
      photo = document.getElementById('photo');
      startbutton = document.getElementById('startbutton');
      photo_test = document.getElementById('photo_test');

      navigator.mediaDevices.getUserMedia({
            
        video:/*{ width: 1280, height: 720 }*/true,
          audio: false
             
          })
          .then(function(stream) {
              video.srcObject = stream;
              video.play();
          })
          .catch(function(err) {
              if (String(err).substring(0,15) == "NotAllowedError")
                alert("veuillez autoriser l'acces à la cam (wsh)");
              console.log("An error occurred: " + err);
          });

      video.addEventListener('canplay', function(ev) {
          if (!streaming) {
              height = video.videoHeight / (video.videoWidth / width);
        
              if (isNaN(height)) {
                  height = width / (4 / 3);
              }

              video.setAttribute('width', width);
              video.setAttribute('height', height);
              canvas.setAttribute('width', width);
              canvas.setAttribute('height', height);
              streaming = true;
          }
      }, false);

      startbutton.addEventListener('click', function(ev) {
          takepicture();
          ev.preventDefault();
      }, false);
  }

  function takepicture() {
      var context = canvas.getContext('2d');
     
        console.log(height);
        console.log(width);
        canvas.width = width;
        canvas.height = height;
        context.drawImage(video, 0, 0, width, height);

          var data = canvas.toDataURL("image/​png");
      
          // cross browser cruft
        // var get_URL = function () {
        //     return window.URL || window.webkitURL || window;
        // };
        // var blob = dataUriToBlob(data);

        // var url = get_URL().createObjectURL(blob);
        // photo_test.setAttribute('src', data);
        // let photo_input = document.getElementById("photo_input").files[0];
        // let formData = new FormData();
        // formData.append("photo", photo_input);
        // fetch('/upload/image', {method: "POST", body: formData})
        // .then(response => console.log(response))
        // .catch(error => console.log(error));

        var photo_test = document.getElementById('photo_test');

        photo.setAttribute('src', data);
    
        // console.log(typeof data);
        photo.classList.remove('hide');
        photo_test.setAttribute('value', data);
        // console.log(url);
        //   document.cookie="photo_src=" + photo.src;
          // window.location.href="montage?photo_src=" + photo.src;
  }
// converts a dataURI to a Blob
// function dataUriToBlob(dataURI) {
//     var byteString = atob(dataURI.split(',')[1]);
//     var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
//     var arrayBuffer = new ArrayBuffer(byteString.length);
//     var _ia = new Uint8Array(arrayBuffer);
//     for (var i = 0; i < byteString.length; i++) {
//         _ia[i] = byteString.charCodeAt(i);
//     }
//     var dataView = new DataView(arrayBuffer);
//     var blob = new Blob([dataView], { type: mimeString });
//     return blob;
// }
  window.addEventListener('load', startup, false);
})();   

// async function SavePhoto(inp) 
// {
//     let user = { name:'john', age:34 };
//     let formData = new FormData();
//     let photo = inp.files[0];      
         
//     formData.append("photo", photo);
//     formData.append("user", JSON.stringify(user));  
    
//     try {
//        let r = await fetch('/upload/image', {method: "POST", body: formData}); 
//        console.log('HTTP response code:',r.status); 
//     } catch(e) {
//        console.log('Huston we have problem...:', e);
//     }
    
// }