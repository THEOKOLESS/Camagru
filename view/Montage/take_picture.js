
(function() {

  var width = 364; // We will scale the photo width to this
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
      selected_image = document.getElementById('selected_image');

      upload = document.getElementById('upload');
      not_available = document.getElementById('not_available');
      accept_btn = document.getElementById('accept_btn');
     

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
                alert("We can't access your webcam so you are allow to upload a picture of you, but only of you ;)");
              video.classList.toggle('hide');
              not_available.classList.toggle('hide');
              startbutton.classList.toggle('hide');
              // upload.classList.toggle('hide');
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

      startbutton.addEventListener('click', function() {
          takepicture();
      }, false);

      
  }


  function takepicture() {
      var context = canvas.getContext('2d');
     
        canvas.width = width;
        canvas.height = height;
        context.drawImage(video, 0, 0, width, height);

          var data = canvas.toDataURL("image/​png");

        var photo_test = document.getElementById('photo_test');

        photo_test.setAttribute('value', data);
        let selected = document.querySelector('.select').src;
        selected_image.setAttribute('value', selected);
  }

  window.addEventListener('load', startup, false);
})();   

