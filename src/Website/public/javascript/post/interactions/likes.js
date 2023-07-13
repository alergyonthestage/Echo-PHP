import { uploadFormData } from "../../utils/ajax.js";

const apiLikeLink = '/api/like'

export async function likePost(postID) {

    //UPDATE VIEW BEFORE CALL API (RESPONSIVE UI)
    toggleViewLike(postID)

    //CALL API
    const formData = new FormData();
    formData.append('post-id', postID);

    uploadFormData(apiLikeLink, formData)
        .then((report) => {
            if(!report.success) {
                toggleViewLike(postID)
            }
        })
        .catch((error) => {
            console.error(error)
            toggleViewLike(postID)
        })
}

function toggleViewLike(postID) {
    const likeButton = document.querySelector(`[like-button="${postID}"]`)
    const likeCounter = document.querySelector(`[like-counter="${postID}"]`)

    let added = likeButton.classList.toggle('post-interaction-button-active')
    let currentCount = parseInt(likeCounter.innerHTML)
    likeCounter.innerHTML = added ? ++currentCount : --currentCount
}