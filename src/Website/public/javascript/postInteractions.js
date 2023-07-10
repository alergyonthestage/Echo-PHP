function addInteractionsListenrs() {
    const $likeButtons = [...document.querySelectorAll('[like-button]')]

    $likeButtons.forEach((likeButton) => {
        likeButton.onclick = () => {
            likePost(likeButton.getAttribute('like-button'))
        }
    })
}

async function likePost(postId) {
    let formData = new FormData();
    formData.append('post-id', postId);
    let response = await fetch('/api/addlike', {
        method: 'POST',
        body: formData
    })
    let result = await response.json()

    const likeButton = document.querySelector(`[like-button="${postId}"]`)
    likeButton.classList.toggle('post-button-active', result.liked)
    const likeCounter = document.querySelector(`[like-counter="${postId}"]`)
    likeCounter.innerHTML = result.likesCount

    return result
}

export {addInteractionsListenrs, likePost}