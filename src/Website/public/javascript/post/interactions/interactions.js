import { showPostCommentsSection } from "./comments.js"
import { likePost } from "./likes.js"
import { play } from "./reproduction.js"

export function addInteractionsListenrs() {
    const playButtons = [...document.querySelectorAll('[play-button]')]
    const sliders = [...document.querySelectorAll('[song-slider]')]
    const likeButtons = [...document.querySelectorAll('[like-button]')]
    const commentButtons = [...document.querySelectorAll('[comment-button]')]
    
    playButtons.forEach((playButton) => {
        playButton.onclick = () => {
            play(playButton.getAttribute('play-button'))
        }
    })

    sliders.forEach((slider) => {
        slider.onchange = (event) => {
            if(window.YTplayer !== null) {
                let playerDuration = window.YTplayer.getDuration();
                let timeToSeek = (event.target.value / 100) * playerDuration;
                window.YTplayer.seekTo(timeToSeek)
            }
        }
        setInterval(() => {
            let sliderValue = (window.YTplayer.getCurrentTime() / window.YTplayer.getDuration()) * 100;
            slider.value = sliderValue
        }, 500)
    })

    likeButtons.forEach((likeButton) => {
        likeButton.onclick = () => {
            likePost(likeButton.getAttribute('like-button'))
        }
    })

    commentButtons.forEach((commentButton) => {
        commentButton.onclick = () => {
            showPostCommentsSection(commentButton.getAttribute('comment-button'))
        }
    })
}