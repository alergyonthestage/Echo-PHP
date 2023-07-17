import Post from "../components/Post.js"
import { loadCommentsPreview } from "./interactions/comments.js"
import { addInteractionsListenrs } from "./interactions/interactions.js";
import { fetchData } from "../utils/ajax.js";

const post = document.getElementById('post')
const postId = post.getAttribute('post-id');

fetchData(`/api/post/${postId}`)
    .then((postData) => {
        post.innerHTML = new Post(postData).render()
        addInteractionsListenrs()
        loadCommentsPreview(postId)
    })
    .catch((error) => {
        post.innerHTML = `Error: ${error}`
    })

