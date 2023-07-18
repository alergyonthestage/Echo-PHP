let currentVideoID = null

export function play(videoID) {
    const playButton = document.querySelector(`[play-button="${videoID}"]`);
    if(window.ytPlayer !== null) {
        if (currentVideoID !== videoID) {
            window.ytPlayer.loadVideoById(videoID, 0, 'small')
            currentVideoID = videoID
        }
        if(window.ytPlayer.getPlayerState() === YT.PlayerState.PLAYING) {
            window.ytPlayer.pauseVideo()
            playButton.innerHTML = '<em class="fas fa-play"></em>'

        } else {
            window.ytPlayer.playVideo()
            playButton.innerHTML = '<em class="fas fa-pause fa-beat-fade"></em>'
        }
    } else {
        console.log('Error: player not found')
    }
}