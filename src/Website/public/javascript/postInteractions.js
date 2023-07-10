import { uploadFormData } from "./utils/ajax";

const apiLikeLink = '/api/addlike'

function addInteractionsListenrs() {
    const $likeButtons = [...document.querySelectorAll('[like-button]')]

    $likeButtons.forEach((likeButton) => {
        likeButton.onclick = () => {
            likePost(likeButton.getAttribute('like-button'))
        }
    })
}

async function likePost(postId) {
    const formData = new FormData();
    formData.append('post-id', postId);
    const report = await uploadFormData(apiLikeLink, formData)
    if(report.success) {
        const likeButton = document.querySelector(`[like-button="${postId}"]`)
        likeButton.classList.toggle('post-button-active', result.liked)
        const likeCounter = document.querySelector(`[like-counter="${postId}"]`)
        likeCounter.innerHTML = result.likesCount
    } else {
        console.log(report.message)
    }
}

export {addInteractionsListenrs}