import { uploadFormData } from "./utils/ajax.js";

const apiLikeLink = '/api/like'

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
    uploadFormData(apiLikeLink, formData)
        .then((report) => {
            const likeButton = document.querySelector(`[like-button="${postId}"]`)
            likeButton.classList.toggle('post-button-active', report.success)
            //const likeCounter = document.querySelector(`[like-counter="${postId}"]`)
            //likeCounter.innerHTML = result.likesCount
        })
        .catch((error) => {
            console.error(error)
        })
}

export {addInteractionsListenrs}