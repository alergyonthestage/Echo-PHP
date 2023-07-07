const $likeButtons = [...document.querySelectorAll('[like-button]')]
console.log($likeButtons)

$likeButtons.forEach((likeButton) => {
    likeButton.onclick = (event) => {
        likePost(event.target.getAttribute('post-id'))
    }
})

async function likePost(postId) {
    console.log("SONO STATA CHIAMATA")
    let formData = new FormData();
    formData.append('post-id', postId);
    response = await fetch('/api/addlike', {
        method: 'POST',
        body: formData
    })
    result = response.json()

    const likeButton = document.querySelector(`[like-button][post-id="${postId}"]`)
    if(result){
        likeButton.classList.add('post-button-active')
    } else {
        likeButton.classList.remove('post-button-active')
    }

    return result
}