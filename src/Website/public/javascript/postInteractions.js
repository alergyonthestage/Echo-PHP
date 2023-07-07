const $likeButtons = [...document.querySelectorAll('[like-button]')]

$likeButtons.forEach((likeButton) => {
    likeButton.onclick = (event) => {
        likePost(event.target.getAttribute('post-id'))
    }
})

async function likePost(postId) {
    let formData = new FormData();
    formData.append('post-id', postId);
    response = await fetch('/api/addlike', {
        method: 'POST',
        body: formData
    })
    result = response.json()
    return result
}