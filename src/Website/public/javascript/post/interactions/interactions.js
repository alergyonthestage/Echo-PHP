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