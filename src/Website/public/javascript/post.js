import Post from "./components/Post.js"
import { addInteractionsListenrs } from "./postInteractions.js";
import { fetchData } from "./utils/ajax.js";

const post = document.getElementById('post')
const postId = post.getAttribute('post-id');

fetchData(`/api/post/${postId}`)
    .then((postData) => {
        post.innerHTML = new Post(postData).render()
        addInteractionsListenrs()
    })
    .catch((error) => {
        post.innerHTML = `Error: ${error}`
    })

const comment = document.getElementById('comment')
const commentPostId = comment.getAttribute('comment-post-id')

async function getCommentData() {
    let $response = await fetch(`/api/comment/${commentPostId}`, {
        method: "GET",
    })
    let $result = await $response.json()
    return $result
}

getCommentData().then((commentData) => {
    comment.innerHTML = new Comment(commentData).render()
})
.catch((error) => {
    comment.innerHTML = `Error: ${error}`
})
