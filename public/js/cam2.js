(function () {
    if (
      !"mediaDevices" in navigator ||
      !"getUserMedia" in navigator.mediaDevices
    ) {
      alert("Camera API is not available in your browser");
      return;
    }

    // get page elements
    const video = document.querySelector("#video");
//    const btnPlay = document.querySelector("#btnPlay");
//   const btnPause = document.querySelector("#btnPause");
    const btnScreenshot = document.querySelector("#btnScreenshot");
    const btnChangeCamera = document.querySelector("#btnChangeCamera");
    const screenshotsContainer = document.querySelector("#screenshots");
    const canvas = document.querySelector("#canvas");
    const devicesSelect = document.querySelector("#devicesSelect");

    // video constraints
    const constraints = {
      video: {
        width: {
          min: 1280,
          ideal: 1920,
          max: 2560,
        },
        height: {
          min: 720,
          ideal: 1080,
          max: 1440,
        },
      },
    };

    // use front face camera
    let useFrontCamera = true;

    // current video stream
    let videoStream;

    // handle events
    // play
/*    btnPlay.addEventListener("click", function () {
      video.play();
      btnPlay.classList.add("is-hidden");
      btnPause.classList.remove("is-hidden");
    });

    // pause
    btnPause.addEventListener("click", function () {
      video.pause();
      btnPause.classList.add("is-hidden");
      btnPlay.classList.remove("is-hidden");
    });
*/
    // take screenshot
    btnScreenshot.addEventListener("click", function () {
      const img = document.createElement("img");
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      canvas.getContext("2d").drawImage(video, 0, 0);
      img.src = canvas.toDataURL("image/png");
      screenshotsContainer.prepend(img);

//My Content////////////////

            var d = new Date();

            var anyo = d.getFullYear();
            var mes = d.getMonth()+1;
            var diya = d.getDate();

            //console.log(anyo+"-"+mes+"-"+diya);
            const aradiya = anyo +"-"+mes+"-"+diya;

            var ora = d.getHours();
            var minunto = d.getMinutes();
            var segundo = d.getSeconds();

            //console.log(ora+":"+minunto+":"+segundo);
            const arahora = ora+":"+minunto+":"+segundo;

            var imgToSend = canvas.toDataURL("image/png");

            const type = btnScreenshot.getAttribute("data-t");
            console.log(type);

            var timeurl;

            if(type==0){
              timeurl = "/timeinUser"
            }
            if(type==1){
              timeurl = "/timeoutUser"
            }

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
              type:'POST',
              url: timeurl,
              data:{
                imgBase64:imgToSend,
                date: aradiya,
                time: arahora
              },
              //cache:false,
              //contentType: false,
              //processData: false,
              success:function(data){
                  console.log("success");
                  window.location.href= "/calendar";
                  console.log(data);
              },
              error: function(data){
                  console.log("error");
                  console.log(data);
              }
            });
////////////////////////////

    }); //take screenshot end brackets

    // switch camera
    btnChangeCamera.addEventListener("click", function () {
      useFrontCamera = !useFrontCamera;

      initializeCamera();
    });

    // stop video stream
    function stopVideoStream() {
      if (videoStream) {
        videoStream.getTracks().forEach((track) => {
          track.stop();
        });
      }
    }

    // initialize
    async function initializeCamera() {
      stopVideoStream();
      constraints.video.facingMode = useFrontCamera ? "user" : "environment";

      try {
        videoStream = await navigator.mediaDevices.getUserMedia(constraints);
        video.srcObject = videoStream;
      } catch (err) {
        alert("Could not access the camera");
      }
    }

    initializeCamera();
  })();
