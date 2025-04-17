<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AI Video with Language Switch</title>

    <link rel="stylesheet" href="{{ asset('style.css') }}" />
  </head>
  <body>
    <div class="content">
      <h1>Welcome to Our Website</h1>
    </div>
    <div class="video-container" id="videoContainer" onclick="toggleSize()">
      <video id="videoPlayer" autoplay muted>
        <source id="videoSource" src="{{ $client->video }}" type="video/mp4" />
        Your browser does not support the video tag.
      </video>


      <div class="language-buttons" id="menuOptions">
        
      </div>

      <button class="control-button mute-button" onclick="toggleMute()">
        🔊
      </button>
      <button class="control-button pause-button" onclick="togglePause()">
        ⏸️
      </button>
      {{-- <button class="control-button back-button" onclick="toggleback()">
        ◀
      </button> --}}
      <button class="close-button" id="closeButton" onclick="closeVideo(event)">
        ❌
      </button>
    </div>


    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>

    <script>
      //json data
      const mainVideo = '{{ $client->video }}';
      const menuArray = {!! ($category) !!}

      //for back button
      const lastIdArray = [];

      //for video player
      let videoQueue = [];
      let videoPlayer = document.getElementById("videoPlayer");
      let videoSource = document.getElementById("videoSource");
      let videoContainer = document.getElementById("videoContainer");

      initHtml();
      
      function initHtml(){
        let menuHTML = '';

        menuArray.forEach((item) => {

            menuHTML += `<button class="itemData ${item.parent_id?'green':'yellow'} item_${item.id} parent_${item.parent_id}" data-item="${item.id}" data-parent="${item.parent_id}" data-video="${item.video}" style="display:${item.parent_id ? 'none' : 'block'}">
              ${item.name}
            </button>`;
        });

        menuHTML += `<button class="back-button" onclick="toggleback()" style="display:none">
              ← Back
            </button>`

        $('#menuOptions').html(menuHTML);

      }

      $(document).on('click', '.itemData', function(){
        let v_item = $(this).data('item');
        let v_parent = $(this).data('parent');
        let v_video = $(this).data('video');

        videoQueue = [v_video];
        lastIdArray.push(v_parent);
        //...
        $('.itemData').hide();
        $('.itemData.parent_'+v_item).show();
        $('.back-button').show();

        $('#menuOptions').removeClass('language-buttons');
        $('#menuOptions').addClass('menu-options');
        //console.log('v_item', v_item)
        //console.log('v_parent', v_parent)

        //...
        playNextVideo();
      });


      function toggleback(){
        let lPop = lastIdArray.pop();

        console

        $('.itemData').hide();
        $('.itemData.parent_'+lPop).show();

        if(!lPop){
          $('.back-button').hide();
          videoQueue = [mainVideo];
          $('#menuOptions').removeClass('menu-options');
          $('#menuOptions').addClass('language-buttons');
        }
        else {
          let lVideo = $('.itemData.item_'+lPop).data('video');
          videoQueue = [lVideo];
        }

        //...
        playNextVideo();
      }








      function playNextVideo() {
        if (videoQueue.length === 0) return;
        videoSource.src = videoQueue.shift();
        videoPlayer.load();
        videoPlayer.play();
        videoPlayer.onended = playNextVideo;
      }



      

      function toggleMute() {
        videoPlayer.muted = !videoPlayer.muted;
      }

      function togglePause() {
        videoPlayer.paused ? videoPlayer.play() : videoPlayer.pause();
      }

      function closeVideo(event) {
        event.stopPropagation();
        videoContainer.style.display = "none";
      }

      let enlarged = false;

      function toggleSize() {
        videoContainer.classList.add("enlarged");
        if(!enlarged)
          toggleMute()

        enlarged = true;
      }
    </script>
  </body>
</html>