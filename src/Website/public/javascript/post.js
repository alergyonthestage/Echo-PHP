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

//comments

const comment = document.getElementById('comment')
const commentPostId = comment.getAttribute('comment-post-id')

fetchData(`/api/comment/${commentPostId}`)
    .then((commentData) => {
        comment.innerHTML = new Comment(commentData).render()
    })
    .catch((error) => {
        comment.innerHTML = `Error: ${error}`
    })
