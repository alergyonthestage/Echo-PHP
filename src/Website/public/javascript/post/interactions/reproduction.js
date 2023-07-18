let currentVideoID = null

export function play(videoID) {
    if(window.ytPlayer !== null) {
        if (currentVideoID !== videoID) {
            window.ytPlayer.loadVideoById(videoID, 0, 'small')
            currentVideoID = videoID
        }
        if(window.ytPlayer.getPlayerState() === YT.PlayerState.PLAYING) {
            window.ytPlayer.pauseVideo()
        } else {
            window.ytPlayer.playVideo()
        }
    } else {
        console.log('Error: player not found')
    }
}