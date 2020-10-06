
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
//         } else {
//           var vendorURL = window.URL || window.webkitURL;
//           video.src = vendorURL.createObjectURL(stream);
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

      navigator.mediaDevices.getUserMedia({
              video: true,
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

      clearphoto();
  }


  function clearphoto() {
      var context = canvas.getContext('2d');
      context.fillStyle = "#AAA";
      context.fillRect(0, 0, canvas.width, canvas.height);

      var data = canvas.toDataURL('image/png');
    //   photo.setAttribute('src', data);
  }

  function takepicture() {
      var context = canvas.getContext('2d');
      if (width && height) {
          canvas.width = width;
          canvas.height = height;
          context.drawImage(video, 0, 0, width, height);

          var data = canvas.toDataURL('image/png');
          photo.setAttribute('src', data);
      } else {
          clearphoto();
      }
  }

  window.addEventListener('load', startup, false);
})();   