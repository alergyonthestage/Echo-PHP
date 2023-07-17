let player = null
let currentVideoID = null

export function play(videoID) {
    if(window.playerReady) {
        if(player === null) {
            player = new YT.Player('player', {
                height: '360',
                width: '640',
                videoId: videoID,
                events: {
                    'onReady': (event) => event.target.playVideo()
                }
            });
            currentVideoID = videoID
        } else if (currentVideoID !== videoID) {
            player.loadVideoById(videoID, 0, 'small')
        }
        if(player.getPlayerState() === YT.PlayerState.PLAYING) {
            player.pauseVideo()
        } else {
            player.playVideo()
        }
    }
}
