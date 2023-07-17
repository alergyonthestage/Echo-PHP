<!DOCTYPE html>
<html>
<head>
  <title>Player YouTube</title>
  <script src="https://www.youtube.com/iframe_api"></script>
  <style>
    #player {
      display: none;
    }
  </style>
</head>
<body>
  <div id="player"></div>

  <script>
    var player;

    function onYouTubeIframeAPIReady() {
      // Creazione del player
      player = new YT.Player('player', {
        height: '360',
        width: '640',
        videoId: 'F90Cw4l-8NY',
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
      });
    }

    function onPlayerReady(event) {
      event.target.playVideo();
    }

    function onPlayerStateChange(event) {
      if (event.data === YT.PlayerState.ENDED) {
        // Esegui qualche azione quando il video è finito
      }

      var playerCurrentTime = player.getCurrentTime();
      var playerDuration = player.getDuration();
      var percentage = (playerCurrentTime / playerDuration) * 100;
      document.getElementById('videoSlider').value = percentage;

      var currentTimeMinutes = Math.floor(playerCurrentTime / 60);
      var currentTimeSeconds = Math.floor(playerCurrentTime % 60);
      document.getElementById('videoTime').innerHTML = currentTimeMinutes + ":" + (currentTimeSeconds < 10 ? "0" : "") + currentTimeSeconds;
    }

    function playVideo() {
      player.playVideo();
    }

    function pauseVideo() {
      player.pauseVideo();
    }

    function seekToTime(value) {
      var playerDuration = player.getDuration();
      var timeToSeek = (value / 100) * playerDuration;
      player.seekTo(timeToSeek);
    }

  </script> 

  <button onclick="playVideo()">Riproduci</button>
  <button onclick="pauseVideo()">Pausa</button>
  <input type="range" id="videoSlider" min="0" max="100" value="0" step="0.01" onchange="seekToTime(this.value)">
  <div id="videoTime">0:00</div>
</body>
</html>
