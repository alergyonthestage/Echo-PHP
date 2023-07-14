import Post from "../components/Post.js"
import { addInteractionsListenrs } from "./interactions/interactions.js";
import { fetchData } from "../utils/ajax.js";

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