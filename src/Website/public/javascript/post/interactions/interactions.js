import { showPostCommentsSection } from "./comments.js"
import { likePost } from "./likes.js"

export function addInteractionsListenrs() {
    const likeButtons = [...document.querySelectorAll('[like-button]')]
    const commentButtons = [...document.querySelectorAll('[comment-button]')]

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